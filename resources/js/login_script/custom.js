function register() 
{
    $('#register').removeClass('sembunyi');
    $('#login-page').addClass('sembunyi');
    $('#forgot-password-form').addClass('sembunyi');

    $('#log-in').removeClass('sembunyi');
    $('#forgot-password').removeClass('sembunyi');
    $('#join-us').addClass('sembunyi');
}

function forgot_password() 
{
    $('#forgot-password-form').removeClass('sembunyi');
    $('#register').addClass('sembunyi');
    $('#login-page').addClass('sembunyi');
    
    $('#join-us').removeClass('sembunyi');
    $('#log-in').removeClass('sembunyi');
    $('#forgot-password').addClass('sembunyi');
}

function login() 
{
    $('#register').addClass('sembunyi');
    $('#forgot-password-form').addClass('sembunyi');
    $('#login-page').removeClass('sembunyi');
    /*  */
    $('#log-in').addClass('sembunyi');
    $('#join-us').removeClass('sembunyi');
    $('#forgot-password').removeClass('sembunyi');
}