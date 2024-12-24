    <?php
        
    include './checkID.php';

    if(!empty($_GET['id']))
    {

        $sqlContacts = $conn->prepare("DELETE FROM contacts WHERE contact_id = ?");
        $sqlContacts->bind_param("i", $contactID);
        $sqlAddresses = $conn->prepare("DELETE FROM addresses WHERE contact_id = ?");
        $sqlAddresses->bind_param("i", $contactID);
        $sqlEmails = $conn->prepare("DELETE FROM emails WHERE contact_id = ?");
        $sqlEmails->bind_param("i", $contactID);
        $sqlPhoneNumbers = $conn->prepare("DELETE FROM phonenumbers WHERE contact_id = ?");
        $sqlPhoneNumbers->bind_param("i", $contactsID);
        
        if($sqlContacts->execute() && $sqlAddresses->execute() && $sqlEmails->execute() && $sqlPhoneNumbers->execute())
        {
                $sqlContacts->close();
                $sqlAddresses->close();
                $sqlEmails->close();
                $sqlPhoneNumbers->close();
            ?>
            <div class="container" id="contactDeletionContainer">

            </div>

            <script>
                window.dismissibleAlert('success', 'Contact has been deleted successfully', 'contactDeletion', 'contactDeletionContainer');

                const myAlertButton = document.getElementById('contactDeletion')
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
                window.dismissibleAlert('danger', 'Oops something went wrong, deletion did NOT happen', 'contactDeletion', 'contactDeletionContainer');
                alert("Oops something went wrong, deletion did NOT happen");

                const myAlertButton = document.getElementById('contactDeletion')
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
        <script>
            alert("SOMETHING WENT TERRIBLY WRONG!");
        </script>
        <?php
    }

    ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
