<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>ADMIN - DASHBOARD</title>
    <html>
    <div>
        <a class="title">ADMIN DASHBOARD</a>
    </div>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <form action="#">
                    <div class="field input-field">
                        <input type="username" placeholder="username" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button id="login-btn">Login</button>
                    </div>
                </form>
    </section>
    </body>

    </html>
</head>

<body>
    <script>
        const loginBtn = document.getElementById("login-btn");
        loginBtn.addEventListener("click", function (event) {
            event.preventDefault(); // prevent default form submission behavior
            const username = document.querySelector(".input").value;
            const password = document.querySelector(".password").value;
            const errorDiv = document.createElement("div");

            errorDiv.classList.add("alert");
            document.querySelector(".form.login").appendChild(errorDiv);

            if (username === "Nvtc_admin" && password === "Nvtc_admin3999") {
                // show cards container
                document.querySelector(".title").style.display = "block";
                document.querySelector(".card").style.display = "block";
                document.querySelector(".card p").style.display = "block";
                document.querySelector(".card h2").style.display = "block";
                document.querySelector(".name").style.display = "block";
                document.querySelector(".email").style.display = "block";
                document.querySelector(".phone").style.display = "block";
                document.querySelector(".message").style.display = "block";
                document.querySelector(".nvnumber").style.display = "block";
                document.querySelector(".delete-button").style.display = "block";
                // hide login form
                document.querySelector(".form.login").style.display = "none";
                document.querySelector(".container").style.display = "none";
                document.querySelector(".form").style.display = "none";
                document.querySelector(".header").style.display = "none";
                document.querySelector(".header").style.display = "none";
                document.querySelector(".form .field").style.display = "none";
                document.querySelector(".btn").style.display = "none";
            } else {
            }
        });
    </script>
    <!--ADD CARDS-->
    <div id="card-container"></div>
    <script>
        // Retrieve ticket data from server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var tickets = JSON.parse(this.responseText);
                // Loop through ticket data and create cards
                for (var i = 0; i < tickets.length; i++) {
                    var ticket = tickets[i];
                    var card = document.createElement('div');
                    card.classList.add('card');
                    card.id = 'card-' + ticket.id;

                    var name = document.createElement('h2');
                    name.classList.add('name');
                    name.innerText = 'Name: ' + ticket.name;
                    card.appendChild(name);

                    var emailLabel = document.createElement('label');
                    emailLabel.id = 'email-label-' + ticket.id;
                    card.appendChild(emailLabel);

                    var email = document.createElement('p');
                    email.classList.add('email');
                    email.innerText = 'Email: ' + ticket.email;
                    email.id = 'email-value-' + ticket.id;
                    card.appendChild(email);

                    var phoneLabel = document.createElement('label');
                    phoneLabel.id = 'phone-label-' + ticket.id;
                    card.appendChild(phoneLabel);

                    var phone = document.createElement('p');
                    phone.classList.add('phone');
                    phone.innerText = 'Phone: ' + ticket.phone;
                    phone.id = 'phone-value-' + ticket.id;
                    card.appendChild(phone);

                    var nvnumberLabel = document.createElement('label');
                    nvnumberLabel.id = 'nvnumber-label-' + ticket.id;
                    card.appendChild(nvnumberLabel);

                    var nvnumber = document.createElement('p');
                    nvnumber.classList.add('nvnumber');
                    nvnumber.innerText = 'NV number: ' + ticket.nvnumber;
                    nvnumber.id = 'nvnumber-value-' + ticket.id;
                    card.appendChild(nvnumber);

                    var messageLabel = document.createElement('label');
                    messageLabel.id = 'message-label-' + ticket.id;
                    card.appendChild(messageLabel);

                    var message = document.createElement('p');
                    message.classList.add('message');
                    message.innerText = 'Message: ' + ticket.message;
                    message.id = 'message-value-' + ticket.id;
                    card.appendChild(message);

                    var ticketlabel = document.createElement('label');
                    ticketlabel.id = 'Ticket-label-' + ticket.ticket_number;
                    card.appendChild(ticketlabel);

                    // Add ticket number to card
                    var ticketNumber = document.createElement('p');
                    ticketNumber.classList.add('ticket-number');
                    ticketNumber.innerText = 'Ticket Number: ' + ticket.ticket_number;
                    card.appendChild(ticketNumber);

                    var deleteButton = document.createElement('button');
                    deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
                    deleteButton.classList.add('delete-button');
                    deleteButton.addEventListener('click', function () {
                        var cardToRemove = document.getElementById('card-' + ticket.id);
                        cardToRemove.parentNode.removeChild(cardToRemove);

                        // Send a DELETE request to the backend to delete the corresponding ticket
                        fetch('/delete-ticket.php?id=' + ticket.id, { method: 'DELETE' })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Failed to delete ticket');
                                }
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    });
                    card.appendChild(deleteButton);
                    document.getElementById('card-container').appendChild(card);
                }
            }
        };
        xhr.open('GET', 'get_tickets.php', true);
        xhr.send();
        const forms = document.querySelector(".forms"),
            pwShowHide = document.querySelectorAll(".eye-icon"),
            links = document.querySelectorAll(".link");

        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
                let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

                pwFields.forEach(password => {
                    if (password.type === "password") {
                        password.type = "text";
                        eyeIcon.classList.replace("bx-hide", "bx-show");
                        return;
                    }
                    password.type = "password";
                    eyeIcon.classList.replace("bx-show", "bx-hide");
                })

            })
        })

        links.forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault(); //preventing form submit
                forms.classList.toggle("show-signup");
            })
        })

    </script>
</body>

</html>