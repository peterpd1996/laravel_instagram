<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Manual;
use App\Enums\SettingType;
use App\Enums\Role;
use GuzzleHttp\Client;

class RoleUserService
{
    protected $user;
    protected $manual;
    protected $client;
    protected $settingService;
    protected $mailService;
    protected $userService;

    /**
     * RoleUserService constructor.
     *
     * @param User $user
     * @param Manual $manual
     * @param Client $client
     * @param MailService $settingService
     * @param SettingService $mailService
     * @param UserService $userService
     */
    public function __construct(
        User $user,
        Manual $manual,
        Client $client,
        MailService $mailService,
        SettingService $settingService,
        UsersService $userService
    )
    {
        $this->user = $user;
        $this->manual = $manual;
        $this->client = $client;
        $this->mailService = $mailService;
        $this->settingService = $settingService;
        $this->userService = $userService;
    }

    /**
     * Update user for admin site
     *
     * @param ['user_id', 'luc_user_id', 'role'] $params
     * @return array
     */
    public function updateUser(array $params)
    {
        try {
            $userObject = $this->user->find($params['user_id']);
            $manualObject = $this->manual->where('user_id', $params['user_id'])->first();
            if (is_null($userObject) || is_null($manualObject)) {
                return [
                    'code' => 404,
                    'message' => trans('responses.userNotFound')
                ];
            }
            $content = '';
            $role = $params['role'];
            if ($userObject->role != $role) {
                $content .= trans('responses.changeRoleContent', [
                        'user_id' => $userObject->id,
                        'old_role' => Role::getKey($userObject->role),
                        'new_role' => Role::getKey((int)$role)
                    ]) . '\n';
            }
            $supportId = $params['luc_user_id'];
            if ($manualObject->luc_user_id != $supportId) {
                $response = $this->client->post(config('services.luc.domain') . '/api/dashboard/search', [
                    'json' => [
                        'supportId' => $supportId
                    ]
                ]);
                $responseUser = json_decode($response->getBody());
                if ($responseUser->code != 200) {
                    return [
                        "code" => 400,
                        "message" => trans('responses.accountNotExist'),
                    ];
                }

                $checkUser = $this->userService->checkLucUser($supportId);
                if ($checkUser['code'] != 200) {
                    return [
                        'code' => $checkUser['code'],
                        'message' => $checkUser['message']
                    ];
                }

                $content .= 'Change luc id of user have id ' . $userObject->id
                    . ' from ' . $manualObject->luc_user_id . ' to ' . $supportId . '\n';
            }

            DB::beginTransaction();
            if ($manualObject->luc_user_id != $supportId) {
                $updateResult = $this->updateAutoUser($supportId, $manualObject->luc_user_id, $userObject->provider_code);
                if (!$updateResult) {
                    return [
                        'code' => 500,
                        'message' => trans('responses.somethingWentWrong')
                    ];
                }
                $manualObject->update([
                    "luc_user_id" => $supportId,
                    "luc_user_name" => $responseUser->data->name,
                    "email" => $responseUser->data->email
                ]);
                $this->mailService->changeLucAccount($manualObject);
            }
            if ($userObject->role != $role) {
                $userObject->update(['role' => $role]);
            }
            if (!empty($content)) {
                $historySettingData = [
                    'type' => SettingType::USER,
                    'content' => $content
                ];
                $this->settingService->storeHistory($historySettingData);
            }
            DB::commit();
            return [
                'code' => 200,
                'message' => trans('responses.updateUserSuccess')
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'code' => 500,
                'message' => trans('responses.somethingWentWrong')
            ];
        }
    }

    /**
     * @param int $supportId
     * @param int $oldSupportId
     * @param string $providerCode
     */
    protected function updateAutoUser($supportId, $oldSupportId, $providerCode)
    {
        try {
            $response = $this->client->post(config('services.luc.domain') . '/api/auto-user/update-support-id', [
                'json' => [
                    'support_id' => $supportId,
                    'old_id' => $oldSupportId,
                    'provider_code' => $providerCode,
                ]
            ]);
            $responseUser = json_decode($response->getBody());
            if ($responseUser->code != 200) {
                return false;
            }
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return false;
        }

        return true;
    }
}
