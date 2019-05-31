  <h3 align="center"style="color:blue;"><?php print_r($this->session->flashdata('success'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('unsuccess'));?></h3>
  <h3 align="center"style="color:red;"><?php print_r($this->session->flashdata('error'));?></h3>
  
    <div class="main-content">
      <!-- You only need this form and the form-basic.css -->
         <form action="Customer/insert" method="post" id="form-basic" class="form-basic">   
            <div class="form-title-row">
                <h1>Add Customer</h1>
            </div>



            <div class="form-row">

                <label>

                    <span>Customer Name <b style="color:red;"> *</b></span>

                   <input type="text" name="customer_name" id="customer_name" required>

                </label>

            </div>

            <div class="form-row">
                <label>
                    <span>Customer Mobile <b style="color:red;"> *</b></span>
                   <input type="number" name="mobile" id="mobile" required>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Customer NickName</span>
                   <input type="text" name="nickname" id="nickname" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Customer Address </span>
                   <input type="text" name="address" id="address" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Reference</span>
                   <input type="text" name="reference" id="reference" >
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Customer Intrest</span>
                   <input type="text" name="intrest" id="intrest" >
                </label>
            </div>


            <div class="form-row">

                <button type="submit">Add</button>

            </div>



        </form>



    </div>



</body>



</html>

