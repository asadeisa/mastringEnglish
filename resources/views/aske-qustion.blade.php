@extends("layout.homelayout")
@section('home')
<x-user-nav/>
<div class="user-interface d-flex mt-5 pt-1   w-100 ">

  <x-user-aside/>
  {{-- <style type="text/css">
    .audu-recrder {
        position: absolute;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
            -ms-flex-pack: center;
                justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
            -ms-flex-align: center;
                align-items: center;
        height: 100%;
        width: 100%;
        margin: 0;
    }
    .holder {
        background-color: #4c474c;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#4c474c), to(#141414));
        background-image: -o-linear-gradient(bottom, #4c474c 0%, #141414 100%);
        background-image: linear-gradient(0deg, #4c474c 0%, #141414 100%);
        border-radius: 50px;
    }
    [data-role="controls"] > button {
        margin: 50px auto;
        outline: none;
        display: block;
        border: none;
        background-color: #D9AFD9;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#D9AFD9), to(#97D9E1));
        background-image: -o-linear-gradient(bottom, #D9AFD9 0%, #97D9E1 100%);
        background-image: linear-gradient(0deg, #D9AFD9 0%, #97D9E1 100%);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        text-indent: -1000em;
        cursor: pointer;
        -webkit-box-shadow: 0px 5px 5px 2px rgba(0,0,0,0.3) inset, 
            0px 0px 0px 30px #fff, 0px 0px 0px 35px #333;
                box-shadow: 0px 5px 5px 2px rgba(0,0,0,0.3) inset, 
            0px 0px 0px 30px #fff, 0px 0px 0px 35px #333;
    }
    [data-role="controls"] > button:hover {
        background-color: #ee7bee;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ee7bee), to(#6fe1f5));
        background-image: -o-linear-gradient(bottom, #ee7bee 0%, #6fe1f5 100%);
        background-image: linear-gradient(0deg, #ee7bee 0%, #6fe1f5 100%);
    }
    [data-role="controls"] > button[data-recording="true"] {
        background-color: #ff2038;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ff2038), to(#b30003));
        background-image: -o-linear-gradient(bottom, #ff2038 0%, #b30003 100%);
        background-image: linear-gradient(0deg, #ff2038 0%, #b30003 100%);
    }
    [data-role="recordings"] > .row {
        width: auto;
        height: auto;
        padding: 20px;
    }
    [data-role="recordings"] > .row > audio {
        outline: none;
    }
    [data-role="recordings"] > .row > a {
        display: inline-block;
        text-align: center;
        font-size: 20px;
        line-height: 50px;
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 20px;
        color: #fff;
        font-weight: bold;
        text-decoration: underline;
        background-color: #0093E9;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#0093E9), to(#80D0C7));
        background-image: -o-linear-gradient(bottom, #0093E9 0%, #80D0C7 100%);
        background-image: linear-gradient(0deg, #0093E9 0%, #80D0C7 100%);
        float: right;
        margin-left: 20px;
        cursor: pointer;
    }
    [data-role="recordings"] > .row > a:hover {
        text-decoration: none;
    }
    [data-role="recordings"] > .row > a:active {
        background-image: -webkit-gradient(linear, left top, left bottom, from(#0093E9), to(#80D0C7));
        background-image: -o-linear-gradient(top, #0093E9 0%, #80D0C7 100%);
        background-image: linear-gradient(180deg, #0093E9 0%, #80D0C7 100%);
    }
</style> --}}

  {{-- <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/voicecall.js') }}"></script> --}}
 @livewire("aske-question")
</div>