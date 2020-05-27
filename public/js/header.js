$(document).ready(function () {
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        notification()
        $(document).on('keyup', '#searchText', function () {
            var user = $("#searchText").val();
            if (user.trim() != '') {
                $.ajax({
                    url: "/search",
                    method: "POST",
                    data: {
                        user: user,
                    },
                    success: function (data) {
                        $('#resultSearch').html(data)
                    }
                })
            } else {
                $('#resultSearch').html('')
            }
        });

        $("#notify").click(function () {
            $("#notifShow").toggleClass("disable");
            $("#count").html('');
            notification('seen');
        });

        function notification(status = '') {
            $.ajax({
                url: "/notification",
                method: "POST",
                data: {
                    stt: status,
                },
                dataType: "json",
                success: function (data) {
                    if (data.notification != '') {
                        $("#notifShow").html(data.notification);
                    } else {
                        $("#notifShow").html(
                            "<span class='p-3' style='display:block'> you have not receiving notifications</span>"
                        );
                    }

                    if (data.unseen_total > 0) {
                        $("#count").html("<span id='countNofi'>" + data.unseen_total + "</span>");
                    }

                }
            })
        }
        $('.fa-caret-down').click(function () {
            $('.logout').toggleClass('none');
        });

    })