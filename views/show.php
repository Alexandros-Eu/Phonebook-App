<?php
    include 'checkID.php'
?>

<div class="table-responsive">
<table class="table table-dark table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col" class="text-center align-middle">Type</th>
            <th scope="col" class="text-center align-middle">Full Name</th>
            <th scope="col" class="text-center align-middle">Birthday</th>
            <th scope="col" class="text-center align-middle">Email</th>
            <th scope="col" class="text-center align-middle">Country</th>
            <th scope="col" class="text-center align-middle">City</th>
            <th scope="col" class="text-center align-middle">Street</th>
            <th scope="col" class="text-center align-middle">Postal Code</th>
            <th scope="col" class="text-center align-middle">Phone Number</th>
            <th scope="col" class="text-center align-middle">Action</th>
        </tr>
    </thead>
    <tbody class="table-group-divider text-dark-emphasis">
            <?php

                $sql = "SELECT contacts.contact_id, contacts.first_name, contacts.last_name, contacts.birthday,
                        addresses.address_id, addresses.street, addresses.city, addresses.postal, addresses.country,
                        emails.email_id, emails.email_name, phonenumbers.phone_number_id, phonenumbers.phone_number, 
                        phonenumbers.type
                        FROM contacts
                        INNER JOIN addresses ON addresses.contact_id = contacts.contact_id
                        INNER JOIN emails ON emails.contact_id = contacts.contact_id
                        INNER JOIN phonenumbers ON phonenumbers.contact_id = contacts.contact_id
                        WHERE contacts.contact_id = ?";


                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $contactID);
                $stmt->execute();
                $result = $stmt->get_result();
                        

                $i = 1;

                while($row = $result->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td class='text-center align-middle'>" . $row["type"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["birthday"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["email_name"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["country"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["city"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["street"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["postal"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["phone_number"] . "</td>";
                    echo "<td class='text-center align-middle'><a href='/phonebook_app/edit/" . $row["contact_id"] ."' class='btn btn-primary btn-sm btnMediaQuery text-light'>Edit</a> <a href='/phonebook_app/delete/" . $row["contact_id"] ."' class='btn btn-danger btn-sm btnMediaQuery deleteButton my-1 my-xl-0'>Delete</button></td>";
                    echo "</tr>";
                    $i++;
                }

                    echo "<tr class='borderless'>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='borderless'> </td>";
                    echo "<td class='text-center borderless'> 
                            <a href='/phonebook_app/new' class='btn btn-secondary btn-sm d-inline-flex align-items-center'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus-lg' viewBox='0 0 16 16'>
                                    <path fill-rule='evenodd' d='M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2'/>
                                </svg>
                            </a>
                          </td>";


            $stmt->close();
            $conn->close();

            ?>
    </tbody>
    </table>
    </div>

    <script>
        const deleteButtons = document.querySelectorAll('.deleteButton');

        
            deleteButtons.forEach( deleteButton => {
                deleteButton.addEventListener('click', (event) => {
                if(window.confirm("Are you sure you want to delete?"))
                {
                    window.location.href =  event.srcElement.href;
                }
                else
                {
                    event.preventDefault();
                }

                });
            })


    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>