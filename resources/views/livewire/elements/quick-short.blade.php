<div>
    <style>
        /* Input group */
        #section_1 div .input-group-lg {
            margin-top: 40px;
        }

        /* Section 1 */
        #section_1 {
            padding-bottom: 291px;
            transform: translatex(0px) translatey(0px);
        }

        /* Heading */
        #section_1 .mx-auto h6 {
            margin-top: 14px;
        }

        /* Text center */
        #section_1 .mx-auto h1.text-center {
            margin-top: 14px;
        }

        @media (max-width:575px) {

            /* Heading */
            #section_1 .mx-auto h6 {
                transform: translatex(0px) translatey(9px);
                font-size: 14px;
            }

            /* Text center */
            #section_1 .mx-auto h1.text-center {
                font-size: 35px;
            }

            /* Keyword */
            #keyword {
                font-size: 14px;
            }

            /* Section 1 */
            #section_1 {
                padding-bottom: 160px;
                padding-top: 122px;
            }

        }

        @media (min-width:992px) {

            /* Heading */
            #section_1 .mx-auto h6 {
                font-size: 18px;
            }

        }

        @media (min-width:1200px) {

            /* Text center */
            #section_1 .mx-auto h1.text-center {
                font-size: 40px;
            }

        }

        /* Rounded */
        #section_1 div .rounded {
            background-color: rgba(41, 128, 185, 0.44);
        }
    </style>
    <form wire:submit.prevent="shortLink" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
        <div class="input-group input-group-lg">
            <span class="input-group-text" style="font-size: 2rem" id="basic-addon1">
                <i class="fas fa-link"></i>
            </span>
            <input wire:model="url" type="search" class="form-control" id="keyword"
                placeholder="Link to short quickly → flyl.ink/avRAsg" aria-label="Search">
            <button type="submit" class="form-control">
                Short
            </button>
        </div>
       
    </form>
    @if ($errorMessage)
        <div class="ps-5 ms-3">
           <p class="text-danger"><small>{{ $errorMessage }}</small></p>
        </div>
    @endif
    @if (auth()->check())
        <p class="text-center">
            <a class="btn btn-sm bnt-outline-success" href="{{ route('dashboard') }}">Check Your Links on dashboard.</a>
        </p>
    @elseif ($shortenedUrls)
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="p-2 rounded shadow mt-3">
                    <h6 class="text-white text-center">Your Shortened URLs:</h6>
                    <ul class="list-group list-group-flush">
                        @foreach ($shortenedUrls as $index => $url)
                            <li class="list-group-item bg-transparent">
                                <a id="short-url-{{ $index }}" href="{{ $url }}" target="_blank"
                                    class="text-white">{{ $url }}</a>
                                <button onclick="copyToClipboard('short-url-{{ $index }}')"
                                    class="btn btn-sm btn-outline-light rounded-circle me-3 ms-2">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <a href="{{ str_replace('-', '+', $url) }}" target="_blank"
                                    class="btn btn-sm btn-outline-light rounded-circle ms-2">
                                    <i class="fa-solid fa-chart-column"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-white"><small>Enter/Pest url in url box.</small></p>
    @endif
</div>

<script>
    function copyToClipboard(elementId) {
        // Get the text field
        var copyText = document.getElementById(elementId).href;

        // Create a temporary input to copy the text
        var tempInput = document.createElement("input");
        tempInput.style.position = "absolute";
        tempInput.style.left = "-9999px";
        tempInput.value = copyText;
        document.body.appendChild(tempInput);

        // Select the text field
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        document.execCommand("copy");

        // Remove the temporary input
        document.body.removeChild(tempInput);

        // Alert the copied text (Optional)
        // alert("Copied the link: " + copyText);
        copyText.className = 'text-success';
        alert()
    }
</script>
