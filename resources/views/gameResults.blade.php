@extends('layouts.master')
@section('content')
<head>
	<title>Results</title>
</head>
<body>
	<h1>Thanks for playing!</h1>

	<div>
		@if ($gameWinner)

			<h2>You won! Please select an organization to receive your contribution!</h2>
			<a href="/charities"></a>
		
		@else

			<h2>Aw, man! You didn't win this one, but you should try again!</h2>
			<a href="/playGame"></a>

		@endif 
	</div>
</body>
</html>