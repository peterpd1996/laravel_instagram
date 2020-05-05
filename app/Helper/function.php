<?php
function getTimeDistance($timePost){
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timeNow=time() + 1;
  $timePost = strtotime($timePost);
  $timeDistance = $timeNow - $timePost;
  $minute = 60;
  $hour = $minute * 60;
  $day =  $hour * 24;
  $week = $day * 7;
  $month = date("t") * $day; // date("t") lấy ra số ngày trong tháng hiện tại
  $year = $day * 365;
  switch($timeDistance){
        case ($timeDistance < $minute):
          $result = ($timeDistance == 1 ) ?  trans('home.post.second_created',['time' => $timeDistance ]) : trans('home.post.seconds_created',['time' => $timeDistance ]);
          break;
        case($timeDistance >= $minute && $timeDistance < $hour):
          $timeDistance = round($timeDistance/$minute);
          $result = ($timeDistance == 1 ) ? trans('home.post.minute_created',['time' => $timeDistance ]) : trans('home.post.minutes_created',['time' => $timeDistance ]);
          break;
        case($timeDistance >= $hour && $timeDistance < $day):
          $timeDistance = round($timeDistance/$hour);
          $result = ($timeDistance == 1 ) ? trans('home.post.hour_created',['time' => $timeDistance ]) : trans('home.post.hours_created',['time' => $timeDistance ]);
          break;
        case($timeDistance >= $day && $timeDistance < $week):
          $timeDistance = round($timeDistance/$day);
          $result = ($timeDistance == 1 ) ? trans('home.post.day_created',['time' => $timeDistance ]) : trans('home.post.days_created',['time' => $timeDistance ]);
          break;
        case($timeDistance >= $week && $timeDistance < $month):
          $timeDistance = round($timeDistance/$week);
          $result = ($timeDistance == 1 ) ? trans('home.post.week_created',['time' => $timeDistance ]) : trans('home.post.weeks_created',['time' => $timeDistance ]);
          break;
        case($timeDistance >= $month && $timeDistance < $year):
          $timeDistance = round($timeDistance/$month);
          $result = ($timeDistance == 1 ) ? trans('home.post.month_created',['time' => $timeDistance ]) : trans('home.post.months_created',['time' => $timeDistance ]);
          break;
        default:
          $result = date('H:i d-m-Y', time()); 
      }
    return $result;
}
 function getImage($filename)
    {
        if(pathinfo($filename, PATHINFO_EXTENSION) != 'mp4')
        return "<img class='mr-2 w-img' src='/uploads/{$filename}'>";
    }
function getTimeFormat($date){
  return date_format($date,"H:i: d-m-Y");
}
// $timePost = '2019-08-16 17:19:29';
// echo getTimeDistance($timePost);
?>