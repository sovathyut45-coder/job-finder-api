<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>

    <h2>Reset Password</h2>

    <form>

        <input
            type="hidden"
            name="token"
            value="{{ $token }}">

        <input
            type="hidden"
            name="email"
            value="{{ $email }}">

        <div>
            <label>New Password</label>
            <input
                type="password"
                name="password">
        </div>

        <div>
            <label>Confirm Password</label>
            <input
                type="password"
                name="password_confirmation">
        </div>

        <button type="submit">
            Reset Password
        </button>

    </form>

</body>

</html>