<head>
    <style>
        #drop-area {
            border: 2px dashed #ccc;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #drop-area:hover {
            background-color: #f9f9f9;
        }

        #drop-area.drag-over {
            border-color: #007bff;
            background-color: #f1faff;
        }

        .drop-icon {
            font-size: 24px;
            color: #888;
            margin-bottom: 10px;
        }

        .drop-text {
            font-size: 16px;
            color: #555;
        }

        .preview-container img {
            max-height: 200px;
        }
    </style>

    @extends('user.layout')
    @section('title', trans('general.User_Profile'))
    @section('content')


        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Edit_Profile') }}</h4>
                    </div>


                </div>

                <!-- General Form -->

                <div class="row">
                    <div class="col-12">
                        <form enctype="multipart/form-data" method="post"
                            action="{{ route('account.update-profile', $item->id) }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="fullName"
                                                    class="form-label">{{ trans('general.First_Name') }}</label>
                                                <input name="firstName" type="text" value="{{ $item->firstName }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="university_name" class="form-label">Name der Universität</label>
                                                <input name="university_name" type="text"
                                                    value="{{ $item->university_name }}" class="form-control">
                                            </div>


                                            <div class="mb-3">
                                                <label for="student_tutor" class="form-label">Tutor oder Student</label>
                                                <select id="student_tutor" class="form-control" name="student_tutor">
                                                    <option value="1"
                                                        {{ $item->student_tutor == 1 ? 'selected' : '' }}>Student</option>
                                                    <option value="2"
                                                        {{ $item->student_tutor == 2 ? 'selected' : '' }}>Tutor</option>
                                                </select>

                                            </div>

                                            <div class="mb-3">
                                                <label for="fullName"
                                                    class="form-label">{{ trans('general.Last_Name') }}</label>
                                                <input name="lastName" type="text" value="{{ $item->lastName }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="fullName"
                                                    class="form-label">{{ trans('general.Email') }}</label>
                                                <input name="email" type="text" value="{{ $item->email }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email"
                                                    class="form-label">{{ trans('general.Upload_Image') }}</label>

                                                <div id="drop-area">
                                                    @if (!empty($item->profile))
                                                        <div class="preview-container">
                                                            <img id="preview-image"
                                                                src="{{ asset('Images/' . $item->profile) }}"
                                                                alt="Preview"
                                                                style="max-width: 100%; height: auto; display: block; margin: auto;" />
                                                        </div>
                                                    @else
                                                        <div class="preview-container" style="display: none;">
                                                            <img id="preview-image" src="#" alt="Preview"
                                                                style="max-width: 100%; height: auto; display: block; margin: auto;" />
                                                        </div>
                                                    @endif
                                                    <div class="upload-instructions">
                                                        <div class="drop-icon">
                                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
                                                    </div>
                                                </div>
                                                <input type="file" id="file-input" name="profile"
                                                    accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="jobCategory"
                                                    class="form-label">{{ trans('general.Career_Category') }}</label>
                                                <select id="jobCategory" class="form-control" name="job_category">
                                                    <option value="">{{ trans('general.Select_Category') }}</option>
                                                    @foreach (App\Models\CareerJobs::where('parent_id', 0)->get() as $itemcategoryjob)
                                                        <option value="{{ $itemcategoryjob->id }}"
                                                            {{ $itemcategoryjob->id == ($job_cate ?? '') ? 'selected' : '' }}>
                                                            {{ $itemcategoryjob->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jobs"
                                                    class="form-label">{{ trans('general.Career_Jobs') }}</label>
                                                <select id="jobs" class="form-control" name="job_id">

                                                    @if (!empty($job_cate))
                                                        @foreach (App\Models\CareerJobs::where('parent_id', $job_cate)->get() as $jobItem)
                                                            <option value="{{ $jobItem->id }}"
                                                                {{ $jobItem->id == ($job ?? '') ? 'selected' : '' }}>
                                                                {{ $jobItem->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            
                                            <div class="mb-3">
                                                <label for="jobCategory"
                                                    class="form-label">Deine Ziele</label>
                                                 <input name="goal" type="text" value="{{ $item->goals }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="jobCategory"
                                                    class="form-label">Dein aktueller Fortschritt</label>
                                                 <input name="current_priogress" type="text" value="{{ $item->current_priogress }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jobCategory"
                                                    class="form-label">Dein Studienfach/Inberessengebiet</label>
                                                 <input name="subject" type="text" value="{{ $item->subject }}"
                                                    class="form-control">
                                            </div>


                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <!-- Interest Workshop -->
                                                <div class="col-md-4">
                                                    <label for="interest"
                                                        class="form-label">{{ trans('general.Interest_Workshop') }}</label>
                                                    <select class="form-control" name="interest_workshop" required
                                                        id="">
                                                        <option value="">{{ trans('general.Select_Interest') }}
                                                        </option>
                                                        <option value="workshop"
                                                            {{ $item->interest_workshop !== null ? 'selected' : '' }}>
                                                            {{ trans('general.Interest') }}</option>
                                                    </select>
                                                </div>

                                                <!-- Interest Travel & Mobility -->
                                                <div class="col-md-4">
                                                    <label for="interest1"
                                                        class="form-label">{{ trans('general.Interest_Travel_Mobility') }}</label>
                                                    <select class="form-control" name="interest_travel" required
                                                        id="">
                                                        <option value="">
                                                            {{ trans('general.Select_Travel_Mobility') }}</option>

                                                        <option value="travel"
                                                            {{ $item->interest_travel !== null ? 'selected' : '' }}>
                                                            {{ trans('general.Travel_Mobility') }}</option>
                                                    </select>
                                                </div>

                                                <!-- Interest Affiliates -->
                                                <div class="col-md-4">
                                                    <label for="interest2"
                                                        class="form-label">{{ trans('general.Interest_Affiliates') }}</label>
                                                    <select class="form-control" name="interest_affilates" required
                                                        id="">
                                                        <option value="">
                                                            {{ trans('general.Select_Interest_Affiliates') }}</option>

                                                        <option value="affilate"
                                                            {{ $item->interest_affilates !== null ? 'selected' : '' }}>
                                                            {{ trans('general.Interest_Affiliates') }}</option>

                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                                            <button type="button"
                                                onclick="window.location='{{ route('account.dashboard') }}'"
                                                class="btn btn-light"
                                                data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                                        </div>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>

        <script>
            const dropArea = document.getElementById("drop-area");
            const fileInput = document.getElementById("file-input");
            const previewContainer = document.querySelector(".preview-container");
            const previewImage = document.getElementById("preview-image");
            const uploadInstructions = document.querySelector(".upload-instructions");


            dropArea.addEventListener("click", () => fileInput.click());


            dropArea.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropArea.classList.add("drag-over");
            });

            dropArea.addEventListener("dragleave", () => dropArea.classList.remove("drag-over"));

            dropArea.addEventListener("drop", (e) => {
                e.preventDefault();
                dropArea.classList.remove("drag-over");

                const file = e.dataTransfer.files[0];
                if (validateFile(file)) {
                    fileInput.files = e.dataTransfer.files;
                    displayImagePreview(file);
                } else {
                    alert("{{ trans('general.invalid_file_type') }}");
                }
            });

            // Handle file selection through input
            fileInput.addEventListener("change", () => {
                const file = fileInput.files[0];
                if (validateFile(file)) {
                    displayImagePreview(file);
                } else {
                    alert("{{ trans('general.invalid_file_type') }}");
                    fileInput.value = "";
                }
            });


            function validateFile(file) {
                const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
                return file && allowedTypes.includes(file.type);
            }

            function displayImagePreview(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = "block";
                    uploadInstructions.style.display = "none";
                };
                reader.readAsDataURL(file);
            }
        </script>

    @endsection
