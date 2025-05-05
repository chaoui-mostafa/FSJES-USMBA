<!-- resources/views/word/create.blade.php -->

<form action="{{ route('documents.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br><br>

    <label for="message">Message:</label>
    <textarea name="message" id="message" required></textarea><br><br>

    <button type="submit">Generate Document</button>
</form>
