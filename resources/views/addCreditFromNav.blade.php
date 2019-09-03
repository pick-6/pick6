<?php
    use App\User;
    use App\Http\Controllers\Controller;
    $gamesAreFree = Controller::checkIfGamesAreFree();
    $creditForUser = User::select('credit')->where('id', '=', Auth::user()->id)->get();
    $credit = $creditForUser[0]['credit'];
    $creditAmount = money_format('$%i', $credit);
?>
@if(!$gamesAreFree)
    <div class="fc-grey hideOnMobile" style="position: absolute;left:40%;top:25px;">
        Credit Balance:
        <span class="{{ $credit <= 0 ? 'fc-red' : 'fc-green'}} creditBalance" id="creditBalance" data-balance="{{$credit}}">
            {{$creditAmount}}
        </span>

        <a href="#addCreditModal" data-toggle="modal" class="btn btn-success btn-sm" style="margin-left:20px">
            <i class="fas fa-dollar-sign"></i> Add Credit
        </a>
    </div>
@endif
