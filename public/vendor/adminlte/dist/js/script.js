$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
let confirm = $('#confirm-delete');
let message = confirm.text();
let messageEmpty = confirm.attr('data-empty');
let messageDeleteSuccess = confirm.attr('data-delete');

function callApi(data, url, type, dataType = 'json') {
    return $.ajax({
        type: type,
        url: url,
        dataType: dataType,
        data: data,
    })
}

function messageConfirm() {
    return swal({
        title: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
}

function alertSuccessDelete(message) {
    return swal({
        icon: "success",
        title: message,
    });
}

function messageDelete() {
    return swal({
        title: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    });
}

function destroyConfirm(form) {
    let swal = messageDelete();
    swal.then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
}

function destroyResource(url, type, message) {
    return swal({
        title: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                callApi(data = null, url, type)
                    .done(responve => {
                       alertSuccessDelete('Bạn đã xóa thành công !!!')
                         $('.post_'+ responve.id).html("");
                    });
            }
        });
}

function searchAjax(page, url, query) {
    return $.ajax({
        url: url + "?data=" + query + "&page=" + page,
        type: 'get',
    });
}

function deleteMultiAjax(url) {
    return $.ajax({
        type: 'delete',
        url: url,
    });
}

function deleteMulti(id, url, table) {
    if (id.length > 0) {
        let swal = messageConfirm();
        swal({
            title: message,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then( (willDelete) => {

        })
        swal.then((willDelete) => {
            if (willDelete) {
                deleteMultiAjax(url)
                    .done(response => {
                        if (response !== '') {
                            table.html(response);
                            alertSuccessDelete(messageDeleteSuccess)
                        }
                    });
            }
        });
    } else {
        swal({
            title: messageEmpty,
            icon: "warning",
        });
    }
}

function autoFormatPriceWhenInput(keyup) {
    let $this = keyup;
    // Get the value.
    let input = $this.val();
    input = input.replace(/[\D]/g, "");
    if (input === "") {
        input = 0;
    } else {
        input = parseInt(input);
    }
    $this.val(function () {
        return (input === 0) ? "" : input.toLocaleString(); // de-DE thay dau , thanh .
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        console.log(input.files[0]);
        console.log(input.files);
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#img_output').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('change', '#upload-image', function () {
    readURL(this);
});

$('.message-success').delay(2500).fadeOut('slow');





