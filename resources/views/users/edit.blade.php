@extends('users.dashboard')

@section('content')
    <div class="container">
        <h2>Editar Usuario</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required readonly>
            </div>

            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
            </div>

            
            <div class="form-group">
                <label>Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="generatePassword">Generar Contraseña</button>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i id="eyeIcon" class="fa-regular fa-eye"></i>
                            <i id="eyeSlashIcon" class="fa-regular fa-eye-slash" style="display:none;"></i>
                        </button>
                    </div>
                </div>
                <div id="passwordStrength" class="mt-2">
                    <div class="progress">
                        <div id="passwordStrengthBar" class="progress-bar" role="progressbar"></div>
                    </div>
                    <small id="passwordStrengthText"></small>
                    <div id="passwordErrorMessage" class="text-danger" style="display: none;"></div>
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="keepPassword" checked>
                <label class="form-check-label" for="keepPassword">
                    Mantener contraseña
                </label>
            </div>

            <br>
            <button type="submit" class="btn btn-primary" id="createBtn">Actualizar</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#generatePassword").click(function() {
                var password = generateRandomPassword();
                $("#password").val(password);
                updatePasswordStrength(password);
            });

            $('#togglePassword').on('click', function () {
                var passwordInput = $('#password');
                var eyeIcon = $('#eyeIcon');
                var eyeSlashIcon = $('#eyeSlashIcon');

                var type = passwordInput.attr('type');
                if (type === 'password') {
                    passwordInput.attr('type', 'text');
                    eyeIcon.hide();
                    eyeSlashIcon.show();
                } else {
                    passwordInput.attr('type', 'password');
                    eyeIcon.show();
                    eyeSlashIcon.hide();
                }
            });

            $("#keepPassword").change(function() {
                if ($(this).is(":checked")) {
                    $("#password").prop("readonly", true);
                } else {
                    $("#password").prop("readonly", false);
                }
            });

            $("#password").keyup(function() {
                var password = $(this).val();
                updatePasswordStrength(password);

                var strength = calculatePasswordStrength(password);
                var errorMessage = $("#passwordErrorMessage");
                var submitButton = $("#createBtn");

                var commonPasswords = ["12345", "password", "admin", "qwerty", "letmein"]; 
                var forbiddenWords = ["john", "mary", "admin", "user"]; 
                var birthday = "0101"; 

                if (strength < 50 || isCommonPassword(password, commonPasswords) || containsForbiddenWord(password, forbiddenWords) || containsBirthday(password, birthday)) {
                    errorMessage.text("La contraseña no cumple con los requisitos de seguridad. Intente una contraseña más fuerte.");
                    errorMessage.show();
                    submitButton.prop("disabled", true);
                } else {
                    errorMessage.hide();
                    submitButton.prop("disabled", false);
                }
            });

            function isCommonPassword(password, commonPasswords) {
                return commonPasswords.includes(password.toLowerCase());
            }

            function containsForbiddenWord(password, forbiddenWords) {
                var lowerCasePassword = password.toLowerCase();
                return forbiddenWords.some(function(word) {
                    return lowerCasePassword.includes(word);
                });
            }

            function containsBirthday(password, birthday) {
                return password.includes(birthday);
            }

            function generateRandomPassword() {
                var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                var password = "";
                for (var i = 0; i < 12; i++) {
                    password += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                return password;
            }

            function updatePasswordStrength(password) {
                var strength = calculatePasswordStrength(password);
                var progressBar = $("#passwordStrengthBar");
                progressBar.css("width", strength + "%");

                var passwordStrengthText = $("#passwordStrengthText");
                var passwordStrengthClass = "";
                if (strength < 25) {
                    passwordStrengthText.text("Baja");
                    passwordStrengthClass = "bg-danger";
                } else if (strength < 50) {
                    passwordStrengthText.text("Media");
                    passwordStrengthClass = "bg-warning";
                } else if (strength < 75) {
                    passwordStrengthText.text("Alta");
                    passwordStrengthClass = "bg-info";
                } else {
                    passwordStrengthText.text("Segura");
                    passwordStrengthClass = "bg-success";
                }

                progressBar.removeClass().addClass("progress-bar " + passwordStrengthClass);
            }

            function calculatePasswordStrength(password) {
                return Math.min(100, password.length * 8);
            }
        });
    </script>
@endsection