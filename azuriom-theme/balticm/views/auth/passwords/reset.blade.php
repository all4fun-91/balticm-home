@extends('layouts.app')

@section('title', 'Reset Your Password')

@section('content')
<style>
    .bm-reset-page{min-height:calc(100vh - 170px);display:flex;align-items:center;justify-content:center;padding:34px 18px}
    .bm-reset-card{position:relative;width:min(1080px,100%);min-height:620px;display:grid;grid-template-columns:43% 57%;overflow:hidden;border:1px solid rgba(255,255,255,.18);border-radius:24px;background:#05090f;box-shadow:0 30px 100px rgba(0,0,0,.72),inset 0 0 50px rgba(255,255,255,.025)}
    .bm-reset-side{position:relative;display:flex;flex-direction:column;justify-content:space-between;padding:48px 42px 30px;overflow:hidden;background:linear-gradient(180deg,rgba(2,7,14,.18),rgba(2,7,14,.86)),url('https://media.balticm.eu/media/site/1789346383673-4e25ebb7-52fc-45bb-8fcb-f9c96c46b873.png') center/cover no-repeat}
    .bm-reset-side:before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 72% 40%,rgba(52,125,190,.22),transparent 34%),linear-gradient(90deg,rgba(2,6,12,.08),rgba(2,6,12,.45))}
    .bm-reset-side>*{position:relative;z-index:1}
    .bm-reset-brand{display:flex;align-items:center;gap:14px}
    .bm-reset-brand img{width:58px;height:58px;object-fit:cover;border-radius:14px;border:1px solid rgba(255,255,255,.25);background:#02050b}
    .bm-reset-brand strong{display:block;font-size:21px;letter-spacing:.12em;line-height:1;font-weight:900;color:#fff}
    .bm-reset-brand small{display:block;margin-top:7px;color:#ff9a3d;font-size:9px;font-weight:900;letter-spacing:.25em}
    .bm-reset-copy{max-width:390px;margin-top:auto;margin-bottom:auto}
    .bm-reset-eyebrow{margin-bottom:12px;color:#ff9a3d;font-size:10px;font-weight:900;letter-spacing:.27em}
    .bm-reset-copy h1{margin:0;color:#fff;font-size:46px;line-height:.98;letter-spacing:-.045em;font-weight:950}
    .bm-reset-copy h1 span{color:#ff7a18}
    .bm-reset-lead{margin:20px 0 0;color:rgba(255,255,255,.76);font-size:14px;line-height:1.6}
    .bm-reset-benefits{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:0;margin:0 -42px -30px;padding:18px 20px 16px;border-top:1px solid rgba(255,255,255,.16);background:rgba(3,8,14,.78);box-shadow:inset 0 0 26px rgba(0,0,0,.42)}
    .bm-reset-benefit{text-align:center;color:rgba(255,255,255,.7);font-size:9px;font-weight:800;letter-spacing:.07em;text-transform:uppercase;border-right:1px solid rgba(255,255,255,.12);padding:4px 8px}
    .bm-reset-benefit:last-child{border-right:0}
    .bm-reset-benefit i{display:block;margin-bottom:8px;color:#fff;font-size:21px}
    .bm-reset-formside{display:flex;flex-direction:column;justify-content:center;padding:54px 58px 42px;background:linear-gradient(135deg,#080d14,#05080d)}
    .bm-reset-formwrap{width:100%;max-width:540px;margin:0 auto}
    .bm-reset-icon{width:58px;height:58px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;border:1px solid rgba(255,154,61,.3);border-radius:14px;background:rgba(255,122,24,.07);color:#ff9a3d;font-size:24px}
    .bm-reset-title{margin:0 0 10px;text-align:center;color:#fff;font-size:38px;line-height:1.05;font-weight:500;letter-spacing:-.035em}
    .bm-reset-subtitle{max-width:460px;margin:0 auto 28px;color:rgba(255,255,255,.55);font-size:13px;line-height:1.6;text-align:center}
    .bm-reset-field{position:relative;margin-bottom:14px}
    .bm-reset-field i{position:absolute;left:17px;top:50%;transform:translateY(-50%);z-index:1;color:rgba(255,255,255,.52);font-size:19px}
    .bm-reset-field:after{content:'';position:absolute;left:0;bottom:11px;width:24px;height:1px;background:rgba(255,255,255,.2);transform:rotate(28deg);transform-origin:left center;pointer-events:none;z-index:2}
    .bm-reset-field input{width:100%;height:58px;padding:0 18px 0 53px;border:1px solid rgba(255,255,255,.2);background:rgba(255,255,255,.015);color:#fff;font-size:14px;outline:none;clip-path:polygon(0 0,100% 0,100% 100%,4% 100%,0 80%)}
    .bm-reset-field input:focus{border-color:rgba(255,154,61,.72);box-shadow:0 0 0 2px rgba(255,122,24,.08)}
    .bm-reset-field input::placeholder{color:rgba(255,255,255,.38)}
    .bm-reset-error{display:block;margin:-5px 0 12px;color:#ff7b6b;font-size:11px;line-height:1.45}
    .bm-reset-submit{position:relative;width:100%;height:58px;margin-top:8px;border:0;border-radius:0 0 12px 0;background:linear-gradient(180deg,#dff7ff,#a8d8e8);color:#071019;font-size:18px;font-weight:700;cursor:pointer;box-shadow:0 10px 30px rgba(117,190,220,.12);clip-path:polygon(0 0,100% 0,100% 100%,4% 100%,0 80%);overflow:hidden}
    .bm-reset-submit:before{content:'';position:absolute;left:0;bottom:11px;width:24px;height:1px;background:rgba(7,16,25,.32);transform:rotate(28deg);transform-origin:left center;pointer-events:none}
    .bm-reset-submit:hover{filter:brightness(1.06);transform:translateY(-1px)}
    .bm-reset-back{display:flex;justify-content:center;margin-top:17px;margin-bottom:0}
    .bm-reset-back a{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:38px;padding:8px 14px;border:1px solid rgba(150,220,245,.16);border-radius:9px;background:linear-gradient(180deg,rgba(150,220,245,.07),rgba(255,255,255,.025));box-shadow:inset 0 1px 0 rgba(255,255,255,.05),0 6px 18px rgba(0,0,0,.16);color:rgba(225,245,252,.78);text-decoration:none;font-size:12px;font-weight:600;letter-spacing:.01em;transition:.18s ease}
    .bm-reset-back a:hover{color:#e8fbff;border-color:rgba(130,220,250,.48);background:linear-gradient(180deg,rgba(120,205,235,.13),rgba(255,255,255,.04));box-shadow:inset 0 1px 0 rgba(255,255,255,.08),0 8px 24px rgba(55,150,190,.12);transform:translateY(-1px)}
    .bm-reset-note{margin:24px 0 0;color:rgba(255,255,255,.38);font-size:9px;line-height:1.55;text-align:center;letter-spacing:.02em}
    @media (max-width:900px){
        .bm-reset-card{grid-template-columns:1fr;max-width:620px}
        .bm-reset-side{min-height:280px;padding:32px 28px 26px}
        .bm-reset-copy{margin:34px 0 50px}
        .bm-reset-copy h1{font-size:38px}
        .bm-reset-benefits{margin:0 -28px -26px}
        .bm-reset-formside{padding:42px 28px 34px}
    }
    @media (max-width:560px){
        .bm-reset-page{padding:20px 10px}
        .bm-reset-side{min-height:245px}
        .bm-reset-brand img{width:50px;height:50px}
        .bm-reset-brand strong{font-size:18px}
        .bm-reset-copy{margin:25px 0 42px}
        .bm-reset-copy h1{font-size:31px}
        .bm-reset-lead{font-size:12px}
        .bm-reset-benefit{font-size:7px;padding:3px 4px}
        .bm-reset-benefit i{font-size:17px}
        .bm-reset-formside{padding:34px 20px 28px}
        .bm-reset-title{font-size:31px}
    }
</style>

<div class="bm-reset-page">
    <div class="bm-reset-card">
        <section class="bm-reset-side">
            <div class="bm-reset-brand">
                <img src="https://media.balticm.eu/media/site/1789353600524-63dc7873-b363-4d93-a68c-4451208f096d.png?v=2" alt="BalticM">
                <div>
                    <strong>BALTICM</strong>
                    <small>PLAY TOGETHER</small>
                </div>
            </div>

            <div class="bm-reset-copy">
                <div class="bm-reset-eyebrow">ACCOUNT SECURITY</div>
                <h1>SET A NEW <span>PASSWORD.</span></h1>
                <p class="bm-reset-lead">Choose a new password for your BalticM account and get back into the community.</p>
            </div>

            <div class="bm-reset-benefits">
                <div class="bm-reset-benefit"><i class="bi bi-shield-check"></i>Secure Account</div>
                <div class="bm-reset-benefit"><i class="bi bi-people"></i>Safe Community</div>
                <div class="bm-reset-benefit"><i class="bi bi-controller"></i>Play Together</div>
            </div>
        </section>

        <section class="bm-reset-formside">
            <div class="bm-reset-formwrap">
                <div class="bm-reset-icon"><i class="bi bi-shield-lock"></i></div>
                <h2 class="bm-reset-title">Reset Your Password</h2>
                <p class="bm-reset-subtitle">Enter your account e-mail and choose a new password below.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="bm-reset-field">
                        <i class="bi bi-envelope"></i>
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="E-mail address..." autofocus>
                    </div>
                    @error('email')
                        <span class="bm-reset-error">{{ $message }}</span>
                    @enderror

                    <div class="bm-reset-field">
                        <i class="bi bi-lock"></i>
                        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="New password...">
                    </div>
                    @error('password')
                        <span class="bm-reset-error">{{ $message }}</span>
                    @enderror

                    <div class="bm-reset-field">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password...">
                    </div>

                    <button type="submit" class="bm-reset-submit">Reset Password</button>
                </form>

                <div class="bm-reset-back">
                    <a href="{{ url('/') }}#login">← Back to Log In</a>
                </div>
                <p class="bm-reset-note">PASSWORD RECOVERY · Your reset link is secure and can only be used for this account.</p>
            </div>
        </section>
    </div>
</div>
@endsection
