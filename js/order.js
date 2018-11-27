//отмена перезагрузки страницы
$('form').submit(function () {
    return false;
});

$('#submit').on('click', function () {
    var userEmail, userName, userPhone, userStreet, homeNumber, homeCorps;
    var homeFlat, homeFloor, comment, cash,  callback;
    userEmail = $('#email').val();
    userName = $('#name').val();
    userPhone = $('#phone').val();
    userStreet = $('#street').val();
    homeNumber = $('#homeNumber').val();
    homeCorps = $('#corps').val();
    homeFlat = $('#flatNum').val();
    homeFloor = $('#floorNum').val();
    comment = $('#comment').val();
    cash = $('#cash').val();
    // cardPay = $('#card').val();
    callback = $('#notCall').val();
    // console.log(payment);
    $.ajax('./phpScript/ajax.php',{
        'method' : 'get',
        'data' : {
            email: userEmail,
            name: userName,
            phone: userPhone,
            street: userStreet,
            house: homeNumber,
            corps: homeCorps,
            flat: homeFlat,
            floor: homeFloor,
            comment: comment,
            pay: cash,
            // card: cardPay,
            callback: callback
        }
    }).done(function (data) {
        $('#result').html(data);
        console.log(data);
    });
});
