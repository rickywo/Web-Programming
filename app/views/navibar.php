<script>
    $(document).ready(function(){
        $("#lmail_pass").hide();
        $("#code_pass").hide();
        $("#lproceed").hide();
        $("#lproceed").on("click",function(){
            $("#login_submit").submit();
        })
        $("#lmail").keyup(function(){
            var sn = $("#lmail").val();
            var rg = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/g;
            if(rg.test(sn)) {
                $("#lmail_pass").show();
                $("#lmail_warning").hide();
                loginvalidation();
            }
            else {
                $("#lmail_pass").hide();
                $("#lmail_warning").show();
                loginvalidation();
            }
        })
        $("#code").keyup(function(){
            var sn = $("#code").val();
            var rg = /^[0-9A-Za-z]{5}$/g;
            if(rg.test(sn)) {
                $("#code_pass").show();
                $("#code_warning").hide();
                loginvalidation();
            }
            else {
                $("#code_pass").hide();
                $("#code_warning").show();
                loginvalidation();
            }
        })
    })

    function loginvalidation(){
        if(($('#lmail_pass').is(':visible'))&&($('#code_pass').is(':visible'))) {
            $("#lproceed").show();
            $("#lstop").hide();
        }
        else {
            $("#lproceed").hide();
            $("#lstop").show();
        }
    }
</script>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="movie.php">Movie</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
        <li style="float:right;"><a href="#login"><i class="fa fa-sign-in"></i> Login</a></li>
    </ul>
</nav>

<div id="login" class="modalDialog">
    <div>
        <h1 style="font-size: 1.5em; font-family: 'Jura', sans-serif; ">Login</h1>
        <a href="#close" title="Close" class="close">X</a>
        <table class="movie-table" style="background-color:transparent; margin-top: 2em;">
            <form method="post" action="customer.php" id="login_submit">
                <input type="hidden" name="login" value=true>
                <tr>
                <td>
                    <h2>Email</h2>
                </td>
                <td>
                    <h2><input type="text" id="lmail" name="mail" placeholder="john-smith@gmail.com" required></h2>
                </td>
                <td>
                    <h2>
                        <i id="lmail_warning" class="fa fa-exclamation"></i>
                        <i id="lmail_pass" class="fa fa-check"></i>
                    </h2>
                </td>

                </tr>
                <td>
                    <h2>Code</h2>
                </td>
                <td>
                    <h2><input type="text" id="code" name="code" placeholder="5j1gu" required></h2>
                </td>
                <td>
                    <h2>
                        <i id="code_warning" class="fa fa-exclamation"></i>
                        <i id="code_pass" class="fa fa-check"></i>
                    </h2>
                </td>
                </tr>
            </form>
        </table>
        <h2>
            <i id="lproceed" class="fa fa-arrow-right" style="margin-left:5em;"><a class="book-button" href="javascript:void(0)"> Login</a></i>
            <i id="lstop" class="fa fa-times" style="margin-left:5em;"> Please fill all fields</i>
        </h2>
    </div>
</div>