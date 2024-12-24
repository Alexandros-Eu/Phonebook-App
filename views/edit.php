    <?php

    include './checkID.php';

    $full_url = $_SERVER['PHP_SELF'];
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $full_url .= '?' . $_SERVER['QUERY_STRING'];
    }

    ?>

    <div class="container" id="contactEditContainer">

    </div>

    <?php

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

        if(!empty($firstName) && !empty($lastName) && !empty($birthday) && !empty($email) && !empty($country) && !empty($city)
         && !empty($city) && !empty($street) && !empty($postalCode) && !empty($phoneNumber) && !empty($type))
        {
            $sqlContacts = $conn->prepare("UPDATE contacts SET 
                            first_name = ?, last_name = ?, birthday = ?
                            WHERE contact_id = ?");
            $sqlContacts->bind_param("sssi", $firstName, $lastName, $birthday, $contactID);

            $sqlAddresses = "UPDATE addresses SET
                             street = ?, country = ?, city = ?, postal = ?
                             WHERE contact_id = ?";
            $sqlAddresses->bind_param("ssssi", $street, $country, $city, $postalCode, $contactID);

            $sqlEmails = "UPDATE emails SET
                          email_name = ?
                          WHERE contact_id = ?";
            $sqlEmails->bind_param("si", $email, $contactID);

            $sqlPhoneNumbers = "UPDATE phonenumbers SET
                                phone_number = ?, `type` = ?
                                WHERE contact_id = ?";
            $sqlPhoneNumbers->bind_param("si", $phoneNumber, $contactID);

            if($sqlContacts->execute() && $sqlAddresses->execute() && $sqlEmails->execute() && $sqlPhoneNumbers->execute())
            {
                    $sqlContacts->close();
                    $sqlAddresses->close();
                    $sqlEmails->close();
                    $sqlPhoneNumbers->close();
                ?>
                <script>
                    window.dismissibleAlert('success', 'You have successfully edited the contact!', 'contactEdit', 'contactEditContainer');
                    
                    const myAlertButton = document.getElementById('contactEdit')
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
                <script>
                    window.dismissibleAlert('danger', 'Something went wrong!', 'contactEdit', 'contactEditContainer');
                    
                    const myAlertButton = document.getElementById('contactEdit')
                    myAlertButton.addEventListener('click', event => {
                        window.location.href = phonebookURL;
                    })

                setTimeout(function () {
                    window.location.href = phonebookURL;
                }, 3000);
                </script>
                <?php
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
            <form action="<?=$full_url?>" method="POST" class="ms-3" id="findContact">
                <div class="row mb-3">
                    <div class="col md-6">
                        <div class="form-floating">
                            <?php
                                $sqlFindContact = "SELECT * from contacts WHERE contact_id = " . $contactID;
                                $result = mysqli_query($conn, $sqlFindContact);
                                $row = mysqli_fetch_array($result);
                            ?>
                        
                            <input type="text" id="firstName" name="firstName"  value="<?php echo $row['first_name'] ?>" class="form-control" required>
                            <label for="firstName">First Name</label>
                        </div>
                    </div>   
                          
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="lastName" name="lastName" value="<?php echo $row['last_name'] ?>" class="form-control mt-1 mt-md-0" required>
                            <label for="lastName">Last Name</label>
                        </div>
                    </div>
                </div> 

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" id="birthday" name="birthday" value="<?php echo $row['birthday'] ?>" class="form-control" required>
                            <label for="birthday">Birthday</label>
                        </div>
                    </div>
                    <?php
                        $sqlFindEmails = "SELECT * from emails WHERE contact_id = " . $contactID;
                        $result = mysqli_query($conn, $sqlFindEmails);
                        $row = mysqli_fetch_array($result);
                    ?>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" id="email" name="email" value="<?php echo $row['email_name'] ?>" class="form-control mt-1 mt-md-0" required>
                            <label for="birthday">Email</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                        $sqlFindAddresses = "SELECT * from addresses WHERE contact_id = " . $contactID;
                        $result = mysqli_query($conn, $sqlFindAddresses);
                        $row = mysqli_fetch_array($result);
                    ?>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="country" name="country" value="<?php echo $row['country'] ?>" class="form-control" required>
                            <label for="country">Country</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="city" name="city" value="<?php echo $row['city'] ?>" class="form-control mt-1 mt-md-0" required>
                            <label for="city">City</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="street" name="street" value="<?php echo $row['street'] ?>" class="form-control" required>
                            <label for="street">Street</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" id="postalCode" name="postalCode" value="<?php echo $row['postal'] ?>" class="form-control mt-1 mt-md-0" required>
                            <label for="postalCode">Postal Code</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <?php
                        $sqlFindPhoneNumbers = "SELECT * from phonenumbers WHERE contact_id = " . $contactID;
                        $result = mysqli_query($conn, $sqlFindPhoneNumbers);
                        $row = mysqli_fetch_array($result);
                    ?>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $row['phone_number'] ?>" class="form-control mt-1 mt-md-0" required>
                            <label for="phoneNumber">Phone Number</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="type" name="type" value="<?php echo $row['type'] ?>" class="form-control" required>
                            <label for="type">Type</label>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-secondary text-white" href="/phonebook_app" id="redirectCancel">Cancel</a>
            </form>
        </div>
    </div>




    <script>
        document.getElementById("redirectCancel").href = `${phonebookURL}`;

        let submitForm = document.getElementById('findContact'); // Get form element and assign it to a variable

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








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
