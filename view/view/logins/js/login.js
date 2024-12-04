const email_input = document.getElementById('email-input');
const pass_input = document.getElementById('pass-input');
const mailbar = document.getElementById('mailbar');
const maillabel = document.getElementById('maillabel');
const passlabel = document.getElementById('passlabel');

const errorMessage = document.getElementById('error-message');
const button_submit = document.getElementById('submit');


button_submit.addEventListener('click', async function (event) {
    event.preventDefault();

    const email = email_input.value.trim();
    const senha = pass_input.value.trim();

    // Validações básicas no front-end
    if (!email || !senha) {
        showError("Preencha todos os campos.");
        return;
    }

    if (!emailValid()) {
        showError("Email inválido.");
        return;
    }

    if (!passwordValid()) {
        showError("Sua senha deve ter no mínimo 6 caracteres.");
        return;
    }

    try {
        const response = await fetch('http://localhost/expressproject/control/control_login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`
        });
        

        const result = await response.json();

        if (result.status === 'success') {
            window.location.href = result.redirect;
        } else {
            showError(result.message || "Erro ao fazer login.");
        }
    } catch (error) {
        console.error("Erro ao fazer login:", error);
        showError("Erro ao conectar ao servidor.");
    }
});

function showError(message) {
    errorMessage.innerHTML = message;
    errorMessage.style.visibility = "visible";
}


function passwordValid() {
    if (pass_input.value.length >= 6) {
        return true;
    }
}

function emailValid() {
    if ((email_input.value.includes('@') && email_input.value.includes('.') && (email_input.value.includes('.com') || email_input.value.includes('.br') || email_input.value.includes('.com.br')))) {
        return true;
    }
}

// Customizando o input de email e senha para exibir as cores de alerta corretamente.

email_input.addEventListener('focusout', function () {
    if (email_input.value.length > 0) {
        maillabel.style.top = '-20px';
    } else {
        maillabel.style.top = '10px';
    }
});

email_input.addEventListener('input', function () {
    if (email_input.value.length > 0) {
        errorMessage.innerHTML = 'Email inválido';
        errorMessage.style.visibility = 'hidden';
        maillabel.style.top = '-20px';

        if (!(email_input.value.includes('@') && email_input.value.includes('.') && (email_input.value.includes('.com') || email_input.value.includes('.br') || email_input.value.includes('.com.br')))) {
            maillabel.style.color = 'red';
            mailbar.style.backgroundColor = 'red';
            console.log('invalid email');
            errorMessage.innerHTML = 'Email inválido';
            errorMessage.style.visibility = 'visible';
        } else {
            maillabel.style.color = '#0085FDFF';
            errorMessage.style.visibility = 'hidden';
        }
    } else {
        maillabel.style.color = '#999';
        errorMessage.style.visibility = 'hidden';
    }
});

email_input.addEventListener('focus', function () {
    maillabel.style.top = '-20px';
});

pass_input.addEventListener('focus', function () {
    passlabel.style.color = '#999';
    errorMessage.style.visibility = 'hidden';

    if (pass_input.value.length > 5) {
        passlabel.style.color = '#0085FDFF';
    } else {
        if (pass_input.value.length > 0) {
            passlabel.style.color = 'red';
        } else {
            passlabel.style.color = '#999';
        }
    }

    if (!passwordValid() && pass_input.value.length > 0) {
        errorMessage.innerHTML = 'Sua senha deve ter no mínimo 6 caracteres';
        errorMessage.style.visibility = 'visible';
    } else {
        errorMessage.style.visibility = 'hidden';
    }

});

pass_input.addEventListener('input', function () {
    if (pass_input.value.length > 0) {
        passlabel.style.top = '-20px';
    } else {
        passlabel.style.top = '10px';
    }

    if (pass_input.value.length > 5) {
        passlabel.style.color = '#0085FDFF';
    } else {
        if (pass_input.value.length > 0) {
            passlabel.style.color = 'red';
        } else {
            passlabel.style.color = '#999';
        }
    }

    if (!passwordValid() && pass_input.value.length > 0) {
        errorMessage.innerHTML = 'Sua senha deve ter no mínimo 6 caracteres';
        errorMessage.style.visibility = 'visible';
    } else {
        errorMessage.style.visibility = 'hidden';
    }

});

pass_input.addEventListener('focusout', function () {
    if (pass_input.value.length > 5) {
        passlabel.style.color = '#0085FDFF';
        errorMessage.style.visibility = 'hidden';
    } else {
        if (pass_input.value.length > 0) {
            passlabel.style.color = 'red';
        } else {
            passlabel.style.color = '#999';
        }
    }

    if (!passwordValid() && pass_input.value.length > 0) {
        errorMessage.innerHTML = 'Sua senha deve ter no mínimo 6 caracteres';
        errorMessage.style.visibility = 'visible';
    } else {
        errorMessage.style.visibility = 'hidden';
    }

});




