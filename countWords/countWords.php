<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>
<?php

// Part 1
function countWords($str)
{
    // Split the string into an array per whitespace using explode() but we lower the 
    $lower_str = explode(" ", strtolower($str));
    # Sample input 1234 1234 | Output Array ( [0] => 1234 [1] => 1234) 
    print_r($lower_str);

    # Initialize a associative array
    $count_word_occurance = array();

    foreach ($lower_str as $words) {

        # If word already exists in array plus one + instead
        if (isset($count_word_occurance[$words])) {
            $count_word_occurance[$words]++;
        }
        // Else if the word does not exist yet create an associative array for it
        else {
            $count_word_occurance[$words] = 1;
        }

    }

    echo "<table>";
    echo "<tr>
        <th>Word</th>
        <th>Number of times they occured</th>
        </tr>";
    arsort($count_word_occurance);
    foreach ($count_word_occurance as $key => $value) {
        echo "
        <tr>
        <td>$key</td>
        <td>$value</td>
        </tr>";
    }
    echo "</table>";
}

# Part 3
# Check if in the GET request has a name parameter using the isset() and the REQUEST_METHOD
if (isset($_GET['name']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    # Do not allow whitespace input if user hit space or tab as input it will count as not empty because whitespaces are characters.
    if (str_replace(" ", '', $_GET['name']) == "") {
        echo "Please enter a value";
    } else {
        $string = $_GET['name'];
        countWords($string);
    }
}


?>

<!-- Part 2 -->
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
    String: <input type="text" name="name" id="name" required><br>
    <input type="submit">
</form>