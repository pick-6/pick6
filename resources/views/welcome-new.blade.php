@extends('layouts.master')

@section('content')
<style type="text/css">
html {
  background: linear-gradient(#0087c2, #fff);
  background-attachment: fixed;
  font-family: 'Montserrat', sans-serif;
  height: 100%;
  color: #fff;
}

#container {
  background-color: #222;
  width: 30%;
  margin: auto;
  margin-top: 50px;
  padding: 2em;
  border-radius: 8px;
  border: hidden;
  opacity: .98;
}

#buttons,
.login-form,
.signup-form {
  display: grid;
  grid-template-columns: 1fr 1fr;
}

.message {
   grid-column: 1/3;
   align-self: center;
   text-align: center;
   margin: 1.5em;
}


.signup,
.login {
  height: 3em;
  display: flex;
  align-items: center;
  justify-content: center;
  border: hidden;
  font-size: large;
  font-weight: bold;
  color: #fff;
  cursor: pointer;
  background-color: #fff4;
}


.signup {
  border-radius: 8px 0 0 8px;
  
}


.login {
  border-radius: 0 8px 8px 0;
  background-color: #fff4;
}

.active {
  background-color: #fed136;
  color: #111;
}

.hide {
  display: none;
  
}
.form-input {
  grid-column: 1/3;
  height: 2em;
  border: hidden;
  border-radius: 8px;
  font-family: 'Montserrat', sans-serif;
  padding-left: 1em;
  font-size: 0.9em;
  margin-bottom: 2em;
  background-color: #fff4;
}


::placeholder {
  color: #fff;
}


.forgot-pass {
  grid-column: 1/3;
  text-align: right;
  font-size: 0.8em;
  position: relative;
  top: -1em;
}


.button,
.forgot-link {
  cursor: pointer;
}


input[type="submit"] {
  grid-column: 1/3;
  height: 3em;
  padding: 0;
  background-color: #fed136;
  border: hidden;
  border-radius: 8px;
  text-transform: uppercase;
  font-size: large;
  font-weight: 800;
  letter-spacing: 3px;
  color: #111;
}


.form-input:focus {
  box-shadow: 0 0 0 2px #FEC503;
}


input {
  outline: none;
}


.button:hover {
  background-color: #FEC503;
  color: #111;
}


@media (max-width: 700px) {
  #container {
    width: 80%;
  }
}
@media (min-width: 700px) {
  .first-name {
    grid-column: 1/2;
    margin-right: 1em;
  }
  .last-name {
    grid-column: 2/3;
    margin-left: 1em;
  }
}
</style>
@if (Auth::check())
	<div>
		
	</div>
@else
	<div id="container">
		<div id="buttons">
			<input type="button" class="button signup" value="Sign Up">
			<input type="button" class="button login active" value="Log In">
		</div>

		<form class="login-form">
			<h2 class="message">Welcome back!</h2>
			<input type="email" class="form-input" name="email" placeholder="Email Adress*">
			<input type="password" class="form-input" name="password" placeholder="Password*">
			<div class="forgot-pass"><span class="forgot-link">Forgot Password?</span></div>
			<input type="submit" class="button" name="submit" value="Log in">
		</form>

		<form class="signup-form hide">
			<h2 class="message">Sign Up for Free</h2>
			<input type="text" class="form-input first-name" name="firstname" placeholder="First Name*">
			<input type="text" class="form-input last-name" name="lastname" placeholder="Last Name*">
			<input type="email" class="form-input" name="email" placeholder="Email Adress*">
			<input type="password" class="form-input" name="setpassword" placeholder="Set a Password*">
			<input type="submit" class="button" name="submit" value="Get Started">
		</form>
	</div>
@endif


@stop