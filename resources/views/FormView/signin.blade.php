<!-- Spacing -->
<br /><br /><br /><br />

<!-- form -->
<div class="d-flex justify-content-center">
 <form class="Sign_In d-flex flex-column" method="post" action="">
  <h1 class="header bg-dark rounded mx-auto pt-3 pb-3 pl-5 pr-5" style="color: white;">Sign In</h1>
   <?php // Display Validation Errors here ?>
   @if(isset($View))
    <div class="Error bg-dark text-danger mx-auto border rounded px-3 pt-3 pb-1">
    @foreach($View as $Error)
     <p>{{ $Error }}</p>
    @endforeach
    </div>
   @endif


  <div class="label">Name</div>
  <input class="input" type="text" name="name" value=""/>

  <div class="label">Password</div>
  <input class="input" type="password" name="password" value=""/>

  <button class="btn" type="submit" style="background-color: #eaa81b;">Sign In</button>
 </form>
</div>

<!-- Style -->
<style>
.input { border-radius: 5px; }
