$('.login-btn').click(function(e) {
    e.preventDefault();
    $(`input`).removeClass('error');
    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();
    
    $.ajax({
        url: 'vendor/login.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success: function(data) {
            console.log(data.status);
            console.log(data.message);
            if(data.status === true) {
                document.location.href = '/profile.php';
            } else {
                if(data.type === 1)
                {
                    data.fields.forEach(function (field) {
                        $(`input[name=${field}]`).addClass('error');
                    });
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }
    });
});

let avatar = false;
$('input[name="avatar"]').change(function(e) {
    avatar = e.target.files[0];
});


$('.register-btn').click(function(e) {
    e.preventDefault();
    $(`input`).removeClass('error');
    let name = $('input[name="name"]').val(),
        login = $('input[name="login"]').val(),
        email = $('input[name="email"]').val(),
        password = $('input[name="password"]').val(),
        password_confirm = $('input[name="password_confirm"]').val();

    let formData = new FormData();
    formData.append('name', name);
    formData.append('login', login);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);
    formData.append('email', email);
    formData.append('avatar', avatar);
    
    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success: function(data) {
            console.log(data.status);
            console.log(data.message);
            if(data.status === true) {
                document.location.href = '/';
            } else {
                if(data.type === 1)
                {
                    data.fields.forEach(function (field) {
                        $(`input[name=${field}]`).addClass('error');
                    });
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }
    });
});