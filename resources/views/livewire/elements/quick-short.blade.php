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
    <form wire:submit.prevent="shortLink" method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
        <div class="input-group input-group-lg">
            <span class="input-group-text bi-link-45deg" style="font-size: 2rem" id="basic-addon1"></span>
            <input wire:model="url" type="search" class="form-control" id="keyword"
                placeholder="Link to short quickly → flyl.ink/avRAsg" aria-label="Search">
            <button type="submit" class="form-control">Short</button>
        </div>
        @if ($errorMessage)
            <p class="text-white text-center">{{ $errorMessage }}</p>
        @endif
    </form>
    @if ($shortenedUrls)
        <div class="p-2 rounded shadow mt-3">
            <h6 class="text-white text-center">Your Shortened URLs:</h6>
            <ul class="list-group list-group-flush">
                @foreach ($shortenedUrls as $url)
                    <li class="list-group-item bg-transparent">
                        <a href="{{ $url }}" target="_blank" class="text-white">{{ $url }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
