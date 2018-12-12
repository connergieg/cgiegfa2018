<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <style>
            body {
                background-color: lightgray;
            }
            form {
                display: inline-block;
            }
            #user {
                margin-right: 20px;
            }
            #loginDiv {
                background-color: mediumpurple;
                width: 500px;
                border-radius: 20px;
                padding: 20px;
                margin: 20px auto;
            }
            ul {
                list-style-type: none;
                padding: 0px;
            }
        </style>
    </head>
    <body>
        <div id="loginDiv">
            <h1>Login As</h1>
        
            <ul>
                <li>- User can search for products without entering credentials.</li>
                <li>- Admin can update, add, or delete products after logging in.</li>
            </ul>
            
            <nav>
                <form id="user" action="user.php">
                    <button type="submit" class="btn btn-light">User</button>
                </form>
        
                <form id="admin" action="adminLogin.php">
                    <button type="submit" class="btn btn-dark">Admin</button>
                </form>
            </nav>
        </div>
    </body>
</html>