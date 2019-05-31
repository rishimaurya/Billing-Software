<body>
	<h3 style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
    <div class="main-content" id="llogin" style="padding-left:430px !important;">

        <!-- You only need this form and the form-login.css -->

         <?php echo form_open('Login/auth','id="loginForm"','class="form-login"' ); ?> 
            <div class="form-log-in-with-email">

                <div class="form-white-background" style="border-style:solid !important;border-width:1px !important;border-color:white !important;background:#3a3a7d !important;">

                    <div class="form-title-row">
                        <h1 style="color:white !important;">Agarwal Stores</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span style="color:white !important;">Username</span>
                            <input type="text" name="username" style="border-radius:3px;">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span style="color:white !important;">Password</span>
                            <input type="password" name="password" style="border-radius:3px;">
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit">Log in</button>
                    </div>

                </div>

            </div>


        </form>

    </div>
</body>
