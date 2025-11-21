@extends('layouts.auth')
@section('content')
    <div class="mx-auto w-full max-w-[440px]">
        <h1 class="text-3xl font-extrabold text-primary uppercase mb-10">Sign in</h1>

        <form class="space-y-5 dark:text-white" @submit.prevent="window.location='index.html'">
            <div>
                <label>Email</label>
                <input type="email" class="form-input ps-10" placeholder="Enter Email">
            </div>

            <div>
                <label>Password</label>
                <input type="password" class="form-input ps-10" placeholder="Enter Password">
            </div>

            <button type="submit" class="btn btn-gradient w-full uppercase">Sign in</button>
        </form>

        <div class="text-center mt-5 dark:text-white">
            Don't have an account?
            <a href="auth-boxed-signup.html" class="text-primary">SIGN UP</a>
        </div>
    </div>
@endsection
