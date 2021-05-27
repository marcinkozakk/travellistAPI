<!DOCTYPE html>
<html>
<head>
    <title>{{ $travel->title }}</title>
    <style>
        .dates {
            font-size: 1.25em;
            border-collapse: collapse;
            margin-bottom: 1em;
        }
        .dates td {
            border: 1px solid #636b6f;
            padding: 0.25em 0.5em;
        }
        .note {
            background-color: rgba(255, 235, 59, 0.60);
            border: 1px solid rgba(255, 193, 7, 0.80);
            border-radius: 1em;
            padding: 1em;
            margin-bottom: 1em;
        }

        .photo {
            background-color: rgba(3, 169, 244, 0.60);
            border: 1px solid rgba(33, 150, 243, 0.80);
            border-radius: 1em;
            padding: 1em;
            margin-bottom: 1em;
        }

        .photo img {
            width: 100%;
        }
    </style>
</head>
<body>
<h1>{{ $travel->title }}</h1>

<table class="dates">
    <tr>
        <td>Start date</td>
        <td>{{ \Carbon\Carbon::parse($travel->start_date)->toDateString() }}</td>
    </tr>
    <tr>
        <td>End date</td>
        <td>{{ \Carbon\Carbon::parse($travel->end_date)->toDateString() }}</td>
    </tr>
    <tr>
        <td>Likes count</td>
        <td>{{ $likesCount  }}</td>
    </tr>
</table>
@foreach($photosAndNotes as $item)
    @if($item->getTable() === 'notes')
        <div class="note">
            <h2>
                {{ $item->title }}
            </h2>
            <span>{{ \Carbon\Carbon::parse($item->date)->toDateString() }}</span>
            <p>{{ $item->note }}</p>
        </div>
    @else
        <div class="photo">
            <h2>{{ $item->title }}</h2>
            <span>{{ \Carbon\Carbon::parse($item->date)->toDateString() }}</span>
            <img src="{{ url(Storage::url($item->path)) }}">
        </div>
    @endif
@endforeach
<br>

</body>
</html>
