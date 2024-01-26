<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Link</title>
</head>
<body>

    <h2>Generate Link</h2>

    <form id="linkForm">
        @csrf <!-- Include CSRF token for form submissions in Laravel -->
        <label for="userId">Enter User ID:</label>
        <input type="text" id="userId" name="userId" placeholder="Enter user ID">

        <button type="button" onclick="generateLink()">Generate Link</button>
    </form>

    <div id="result">
        <!-- Result will be displayed here -->
    </div>

    <script>
        function generateLink() {
            // Get the user ID from the input field
            var userId = document.getElementById('userId').value;

            // Construct the link using Blade's route function
            var link = '{{ route("admin.listing.get", ["userId" => ":userId"]) }}';
            link = link.replace(':userId', userId);

            // Display the generated link
            document.getElementById('result').innerHTML = '<p>Generated Link: <a href="' + link + '">' + link + '</a></p>';
        }
    </script>

</body>
</html>
