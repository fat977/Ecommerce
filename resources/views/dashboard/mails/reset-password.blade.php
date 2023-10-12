<div>
    <p>hello {{ $admin->name}}</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <a href="{{ route('admin.resetPassword.page',$admin->email) }}" class="btn btn-dark">Reset Password</a>
</div>