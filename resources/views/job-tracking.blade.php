<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Tracking</title>
</head>

<body>
    <p>processed job: {{ $batch->processedJobs() }} of Total Job {{ $batch->totalJobs() }}</p>

    <p>finishing: {{ $batch->finished() }}</p>

    <script>
        setInterval(() => {
            window.location.reload();
        }, 1000);
    </script>
</body>

</html>
