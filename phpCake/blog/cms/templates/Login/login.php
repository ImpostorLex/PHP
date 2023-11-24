<br>
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        background-color: black;
    }

    .user_card {
        height: 450px;
        width: 500px;
        margin-top: auto;
        margin-bottom: auto;
        background: white;
        position: relative;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 5px;

    }

    .brand_logo_container {
        position: absolute;
        height: 200px;
        width: 220px;
        top: -75px;
        border-radius: 50%;
        background: black;
        padding: 10px;
        text-align: center;
    }

    .brand_logo {
        height: 170px;
        width: 200px;
        border-radius: 50%;
    }

    .form_container {
        margin-top: 100px;
        padding: 0 2rem;

    }

    .form_container input {
        height: 40px;
        font-size: 26px;
    }

    .form_container button {
        height: 30px;
        font-size: 16px;

    }

    .login_btn {
        width: 100%;
        background: #c0392b !important;
        color: white !important;
    }

    .login_btn:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }

    .login_container {
        padding: 0 2rem;
    }

    .input-group-text {
        background: white !important;
        color: #000;
        border: 0 !important;
        border-radius: 0.25rem 0 0 0.25rem !important;
    }

    .input_user,
    .input_pass:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
</style>

<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="<?= $this->Url->image('ninja.png') ?>" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form method="post" action="/login">
                    <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]) ?>

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>

                    <button type="submit" class="btn btn-primary mt-3 login_btn">Login</button>
                </form>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    Don't have an account? &nbsp;<a href="/register" class="ml-2">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</div>