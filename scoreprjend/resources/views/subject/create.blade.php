@extends('layout.master')
@section('content')
    <form method="post" action="{{ route('subject.store') }}">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h2 class="text-left mb-4">Create Subject</h2>
                </div>
                <table class="table table-striped">
                    @csrf
                    <div class="row w-80">
                        <div class="col-lg-10 mx-auto">
                            <div class="auto-form-wrapper">
                                <div class="form-group">
                                    <label class="label">Subject Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Subject Name" name="subject_name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="label">Grade</label>
                                    <div class="input-group">
                                        <select id="gradeSelect" name="grade_id" class="form-control" onchange="updateTextBox('gradeSelect', 'gradeTextBox')">
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="label">Semester</label>
                                    <div class="input-group">
                                        <select id="semesterSelect" name="semester" class="form-control" onchange="updateTextBox('semesterSelect', 'semesterTextBox')">
                                            <option value="1">Semester 1</option>
                                            <option value="2">Semester 2</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="label">Text Book</label>
                                    <div class="input-group">
                                        <select id="textBookSelect" name="text_book" class="form-control" onchange="updateTextBox('textBookSelect', 'textBookTextBox')">
                                            <option value="1">Textbook for grade 10</option>
                                            <option value="2">Textbook for grade 11</option>
                                            <option value="3">Textbook for grade 12</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-inverse-outline-success">Add</button>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Update all text boxes when the page loads
            updateTextBox('gradeSelect', 'gradeTextBox');
            updateTextBox('semesterSelect', 'semesterTextBox');
            updateTextBox('textBookSelect', 'textBookTextBox');
        });

        function updateTextBox(selectId, textBoxId) {
            var selectElement = document.getElementById(selectId);
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            document.getElementById(textBoxId).value = selectedOption;
        }
    </script>
@endsection
