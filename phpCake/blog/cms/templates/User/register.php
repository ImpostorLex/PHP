<h2>Register</h2>



<div class="register-photo" style="background-color:black;">
    <div class="form-container">
        <div class="image-holder"></div>

        <form method="post" action="/register">
            <?= $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]) ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>

            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="first_name" class="form-control" required>

            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="last_name" class="form-control" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>

            <button type="submit" class="btn btn-primary mt-3" style="background-color:#d9534f">Register</button>
        </form>
    </div>
</div>