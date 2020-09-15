<style type="text/css">


.d-flex{
  display: flex;
  flex-direction: row;
  background: #f6f6f6;
  border-radius: 0 0 5px 5px;
  padding: 25px;
}
form{
  flex: 4;
}
.Yorder{
  flex: 2;
}
.title{
  background: -webkit-gradient(linear, left top, right bottom, color-stop(0, #5195A8), color-stop(100, #70EAFF));
  background: -moz-linear-gradient(top left, #5195A8 0%, #70EAFF 100%);
  background: -ms-linear-gradient(top left, #5195A8 0%, #70EAFF 100%);
  background: -o-linear-gradient(top left, #5195A8 0%, #70EAFF 100%);
  background: linear-gradient(to bottom right, #5195A8 0%, #70EAFF 100%);
  border-radius:5px 5px 0 0 ;
  padding: 20px;
  color: #f6f6f6;
}
h2{
  margin: 0;
  padding-left: 15px; 
}
.required{
  color: red;
}

.Yorder{
  margin-top: 15px;
  height: 600px;
  padding: 20px;
  border: 1px solid #dadada;
}
table{
  margin: 0;
  padding: 0;
}
th{
  border-bottom: 1px solid #dadada;
  padding: 10px 0;
}
tr>td:nth-child(1){
  text-align: left;
  color: #2d2d2a;
}
tr>td:nth-child(2){
  text-align: right;
  color: #52ad9c;
}
td{
  border-bottom: 1px solid #dadada;
  padding: 12px 25px 12px 0;
}

p{
  display: block;
  color: #888;
  margin: 0;
  padding-left: 25px;
}
.Yorder>div{
  padding: 15px 0; 
}

button{
  width: 100%;
  margin-top: 10px;
  padding: 10px;
  border: none;
  border-radius: 30px;
  background: #52ad9c;
  color: #fff;
  font-size: 15px;
  font-weight: bold;
}
button:hover{
  cursor: pointer;
  background: #428a7d;
}
</style>
<div class="">
  <div class="title">
      <h2>Product Order Form</h2>
  </div>
<div class="row">
<div class="col-md-8 panel panel-default">
  <form action="" method="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">        
                <label>First Name <i class="required">*</i></label>
                <input type="text" name="fname" class="form-control">
            </div>        
        </div>
        <div class="col-md-12">
            <div class="form-group">        

          <label>Last Name <i class="required">*</i></label>
          <input type="text" name="lname"  class="form-control">
        </div>
        </div>
        
        
        <div class="col-md-12">
            <div class="form-group">        

          <label>Company Name (Optional)</label>
          <input type="text" name="cn"  class="form-control">
        </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">        

          <label>Country <i class="required">*</i></label>
          <select name="selection" class="form-control">
            <option value="select">Select a country...</option>
            <option value="SGS">South Georgia and the South Sandwich Islands</option>       
          </select>
        </div>
        </div>        
        
        <div class="col-md-12">
          <label>Street Address <i class="required">*</i></label>
          <input type="text" name="houseadd" placeholder="House number and street name" required class="form-control">
        </div>          
        
        <div class="col-md-12">
          <span>&nbsp;</span>
          <input type="text" name="apartment" placeholder="Apartment, suite, unit etc. (optional)" class="form-control">
        </div>        

        <div class="col-md-12">
            <div class="form-group">        

          <label>Town / City <i class="required">*</i></label>
          <input type="text" name="city" class="form-control"> 
        </div>
        </div>        
        <div class="col-md-12">
            <div class="form-group">        

          <label>State / County <i class="required">*</i></label>
          <input type="text" name="city" class="form-control"> 
        </div>
        </div>        
        <div class="col-md-12">
            <div class="form-group">        

          <label>Postcode / ZIP <i class="required">*</i></label>
          <input type="text" name="city" class="form-control"> 
        </div>
        </div>        
        <div class="col-md-12">
            <div class="form-group">        

          <label>Phone <i class="required">*</i></label>
          <input type="tel" name="city" class="form-control"> 
        </div>
        </div>        
        <div class="col-md-12">
            <div class="form-group">        

          <label>Email Address <i class="required">*</i></label>
          <input type="email" name="city" class="form-control"> 
        <br>
        </div>
        </div>
    </div>
  </form>
</div>
<div class="col-md-4">
  <div class="Yorder">
    <table>
      <tr>
        <th colspan="2">Your order</th>
      </tr>
      <tr>
        <td>Product Name x 2(Qty)</td>
        <td>$88.00</td>
      </tr>
      <tr>
        <td>Subtotal</td>
        <td>$88.00</td>
      </tr>
      <tr>
        <td>Shipping</td>
        <td>Free shipping</td>
      </tr>
    </table><br>    
    <div>
      <input type="radio" name="dbt" value="cd"> Cash on Delivery
    </div>
    <div>
      <input type="radio" name="dbt" value="cd"> Online <span>
      <img src="https://www.logolynx.com/images/logolynx/c3/c36093ca9fb6c250f74d319550acac4d.jpeg" alt="" width="50">
      </span>
    </div>
    <button type="button">Place Order</button>
  </div><!-- Yorder -->
 </div>
 </div>
</div>
