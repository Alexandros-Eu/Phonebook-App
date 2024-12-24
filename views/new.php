<?php

    $full_url = $_SERVER['PHP_SELF'];
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $full_url .= '?' . $_SERVER['QUERY_STRING'];
    }

    if (isset($_POST['submit'])) 
    {

        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $postalCode = mysqli_real_escape_string($conn, $_POST['postalCode']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);

        if(!empty($firstName) && !empty($lastName) && !empty($birthday) && !empty($email) && !empty($country) && !empty($city) && !empty($postalCode) && !empty($phoneNumber))
        {
            $sqlContacts = $conn->prepare("INSERT INTO contacts(first_name, last_name, birthday)
                            VALUES (?, ?, ?)");
            $sqlContacts->bind_param("sss", $firstName, $lastName, $birthday);

            if ($sqlContacts->execute()) 
            {
                $contact_id = $sqlContacts->insert_id;
                $sqlContacts->close();

                $sqlEmails =  $conn->prepare("INSERT INTO emails(contact_id, email_name)
                              VALUES (?, ?)");
                $sqlEmails->bind_param('is', $contact_id, $email);
      
                $sqlAddresses = $conn->prepare("INSERT INTO addresses(contact_id, street, city, postal, country)
                                 VALUES (?, ?, ?, ?, ?)");  
                $sqlAddresses->bind_param('issss', $contact_id, $street, $city, $postalCode, $country);

                $sqlPhoneNumbers = $conn->prepare("INSERT INTO phonenumbers(contact_id, phone_number, `type`)
                                    VALUES (?, ?, ?)");
                $sqlPhoneNumbers->bind_param('iss', $contact_id, $phoneNumber, $type);


            if($sqlEmails->execute() && $sqlAddresses->execute() && $sqlPhoneNumbers->execute())
            {
                    $sqlEmails->close();
                    $sqlAddresses->close();
                    $sqlPhoneNumbers->close();
                ?>

                <div class="container" id="nameCreationSuccess">

                </div>


                <script>
                    dismissibleAlert('success', 'You have successfully added a new name!', 'myAlert', 'nameCreationSuccess');

                    const myAlertButton = document.getElementById('myAlert')
                    myAlertButton.addEventListener('click', event => {
                        window.location.href = phonebookURL;
                    })

                    setTimeout(function () {
                    window.location.href = phonebookURL;
                    }, 3000);
                </script>
                <?php
            }
            else
            {
                ?>
                    <div class="container" id="queryFailure">

                    </div>
                    
                <script>
                    dismissibleAlert('danger', 'Something went wrong!', 'failureAlert', 'queryFailure');
                </script>
                <?php
            }                

            }
    
        }
        else
        {
            ?>

            <div class="container" id="blankAlertContainer">

            </div>

            <script>
                dismissibleAlert('info', 'Please fill in the blank fields', 'blankAlert', 'blankAlertContainer')
            </script>
            <?php
        }
    }

        
    ?>

<div class="position-absolute top-25 start-50 translate-middle" style="margin-top: 24em;">
    <div class="form-floating">
        <form action="<?=$full_url;?>" method="POST" class="ms-3" id="addContact">
            <div class="row mb-3" >
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" id="firstName" name="firstName" class="form-control" required>
                        <label for="firstName">First Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" id="lastName" name="lastName" class="form-control mt-1 mt-md-0" required>
                        <label for="lastName">Last Name</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                        <label for="birthday">Birthday</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" id="email" name="email" class="form-control mt-1 mt-md-0" required>
                        <label for="email">Email</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" id="country" name="country" class="form-control" required>
                        <label for="country">Country</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" id="city" name="city" class="form-control mt-1 mt-md-0" required>
                        <label for="city">City</label>
                    </div>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" id="street" name="street" class="form-control" required>
                        <label for="street">Street</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" id="postalCode" name="postalCode" class="form-control mt-1 mt-md-0" required>
                        <label for="postalCode">Postal Code</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control" required>
                        <label for="phoneNumber">Phone Number</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" id="type" name="type" class="form-control mt-1 mt-md-0" required>
                        <label for="phoneNumber">Type</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <a class="btn btn-secondary text-white" href="#" id="redirectCancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        document.getElementById("redirectCancel").href = `${phonebookURL}`;

        let submitForm = document.getElementById('addContact'); // Get form element and assign it to a variable

        submitForm.addEventListener("submit", function(event) { // Event listener for when form is submitted


            const requiredFields = ['firstName', 'lastName', 'birthday', 'email', 'country', 'city', 'street', 'postalCode', 'phoneNumber', 'type'];
            const alertMessageVariable = ['First Name', 'Last Name', 'Birthday', 'Email', 'Country', 'City', 'Street', 'Postal Code', 'Phone Number', 'Type'];
            let i = 0;

            requiredFields.forEach(field => {
                if(createContainerAlert(field, `Please fill in your ${alertMessageVariable[i]}`))
                {
                    event.preventDefault();
                    i++;
                }

            })

        })

    </script>
