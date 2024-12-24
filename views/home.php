<table class="table table-dark table-striped table-bordered table-hover" id="showallhome" data-page-length="15">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center align-middle">First Name</th>
            <th scope="col" class="text-center align-middle">Last Name</th>
            <th scope="col" class="text-center align-middle">Birthday</th>
            <th scope="col" class="text-center align-middle">Action</th>
        </tr>
    </thead>
    <tbody class="table-group-divider text-dark-emphasis">
            <?php

                $sql = $conn->prepare("SELECT * FROM contacts");
                $sql->execute();
                $result = $sql->get_result();

                $i = 1;

                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<th scope=\"row\" class='align-middle'>" . $i . "</th>";
                    echo "<td class='text-center align-middle'>" . $row["first_name"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["last_name"] . "</td>";
                    echo "<td class='text-center align-middle'>" . $row["birthday"] . "</td>";
                    echo "<td class='text-center align-middle'> <a href='/phonebook_app/show/" . $row["contact_id"] ."' class='btn btn-info btn-sm btnMediaQuery text-light'>Show</a> <a href='/phonebook_app/edit/" . $row["contact_id"] ."' class='btn btn-primary btn-sm btnMediaQuery text-light my-1 my-sm-0'>Edit</a> <a href='/phonebook_app/delete/" . $row["contact_id"] ."' class='btn btn-danger btn-sm btnMediaQuery deleteButton'>Delete</button></td>";
                    echo "</tr>";
                    $i++;
                }

                    echo "<tr class='borderless'>";
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




            ?>
    </tbody>
    </table>


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