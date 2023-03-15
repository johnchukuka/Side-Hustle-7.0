<?php

$errors = [];
$fields = [];
$votes = [];

if (isset($_POST['age'])) {
    $voter_details = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'ward' => $_POST['ward'],
        'pvc' => $_POST['pvc']
    ];

    // Check if voter is above 18 years
    if ($voter_details['age'] == '') {
        $fields['age'] = 'Please enter your age';
    } elseif ($_POST['age'] < 18) {
        array_push($errors, 'You is below 18 years');
    }

    // Check if voter has a PVC
    if ($voter_details['pvc'] == 'no') {
        array_push($errors, "You don't have a PVC for voting");
    }

    // Check voter ward
    if ($voter_details['ward'] == '') {
        $fields['ward'] = 'Please enter your ward';
    } elseif ($voter_details['ward'] !== '020') {
        array_push($errors, 'Ward ' . $voter_details['ward'] . ' does not exist!');
    }

    if ($errors == null) {
        $votes[$_POST['candidate']] = $voter_details;
    }
}

?>

<body>
    <style>
        body {
            background-color: antiquewhite;
        }

        .fm-wrapper,
        .result-box {
            display: block;
            justify-content: center;
            border: 1px solid green;
            width: 400px;
            padding: 30px;
            border-radius: 10px 10px 10px 10px;
            margin: auto;
        }

        .result-box {
            border: none;
        }

        .field-error-msg {
            color: red;
            font-size: 14px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 50px;
            border: none;
            margin: 10px 0px 10px 0px;
        }

        input[type="text"]:hover,
        select:hover {
            background-color: antiquewhite;
            border: 1px solid green;
            padding: 9px;
        }

        input[type="radio"] {
            margin: 10px 0px 10px 0px;
        }

        h2 {
            margin-top: 50px;
            text-align: center;
        }

        button {
            width: 100%;
            display: block;
            background-color: green;
            color: #ffffff;
            border: none;
            border-radius: 50px;
            margin: 10px 0px 10px 0px;
            padding: 10px 20px 10px 20px;
        }

        button:hover {
            background-color: grey;
        }

        .radio {
            display: inline;
            margin: 10px 0px 10px 0px;
        }
    </style>

    <div>
        <h2>Voting System</h2>
    </div>
    <div class="fm-wrapper">
        <form action="" method="post">
            <div>
                <label>What is your name?</label>
                <input type="text" name="name">

            </div>
            <div>
                <label>How old are you? <span style="color: red;">*</span></label>
                <input type="text" name="age" placeholder="Example: 30">
                <span class="field-error-msg"><?php if (isset($fields['age'])) echo $fields['age']; ?></span>
            </div>
            <div>
                <label>What is your ward? <span style="color: red;">*</span></label>
                <input type="text" name="ward" placeholder="Example: 020">
                <span class="field-error-msg"><?php if (isset($fields['ward'])) echo $fields['ward']; ?></span>
            </div>
            <div class="">
                <labe>Who are you voting? <span style="color: red;">*</span></label>
                    <select name="candidate">
                        <option>Candiate 1</option>
                        <option>Candiate 2</option>
                        <option>Candiate 3</option>
                    </select>
            </div>
            <div class="radio">
                <label>Do you have a PVC? <span style="color: red;">*</span></label>
                <span>
                    Yes <input type="radio" value="yes" name="pvc">
                    No <input type="radio" checked value="no" name="pvc">
                </span>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="result-box">
        <?php if ($fields == null) {
            if (isset($_POST['age']) && $errors == null) {
                echo 'Voter eligible to vote';
            } else { ?>
                <?php if (isset($_POST['age'])) echo 'Voter not eligible to vote'; ?>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li style="color: red;"><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>
</body>