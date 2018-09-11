<!-- Spacing -->
<br /><br /><br /><br />

<!-- form -->
<div class="d-flex justify-content-center">
 <form class="Sign_Up d-flex flex-column" method="post" action="">
  <h1 class="header bg-dark rounded mx-auto p-3" style="color: white;">Sign Up</h1>
   <?php // Display Validation Errors here ?>
   @if(isset($View) && !empty($View['Error']))
    <div class="Error bg-dark text-danger mx-auto border rounded px-3 pt-3 pb-1">
    @foreach($View['Error'] as $Error)
     <p>{{ $Error }}</p>
    @endforeach
    </div>
   @endif


  <div class="label">Name</div>
  <input class="input" type="text" name="name" value="@if(isset($View) && !empty($View['Valid']['name'])) {!! trim($View['Valid']['name']) !!} @endif"/>

  <div class="label">Email</div>
  <input class="input" type="email" name="email" value="@if(isset($View) && !empty($View['Valid']['email'])) {!! trim($View['Valid']['email']) !!} @endif"/>

  <div class="label">Password</div>
  <input class="input" type="password" name="password" value=""/>

  <div class="label">Confirm Password</div>
  <input class="input" type="password" name="confirm_password" value=""/>

  <button class="btn" type="submit" style="background-color: #eaa81b;">Sign Up</button>
 </form>
</div>

<!-- Style -->
<style>
.Error {
 width: 100%;
}
.input { border-radius: 5px; }
