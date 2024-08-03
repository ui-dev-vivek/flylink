<x-layout.main>
    <section class="section-padding featured-section">
        {{-- 'original_url', 'shortened_url', 'open', --}}
        <div class="container pt-3">
            <div class="text-center rounded-3 shadow-lg p-3">
                <h3>Shortened URL Analysis</h3>


                <p class="h4 text-dark"><i class="fa-solid fa-chart-line h3 rounded-circle border p-2 border-primary"></i>
                    Link Opned:
                    <b>{{ $link->open }}</b>
                </p>
                <div class="text-dark h5">
                    Shorted Url: <b>{{ url('/') }}/{{ $link->shortened_url }}- </b> &nbsp;&nbsp;|&nbsp;&nbsp;

                    Original Url: <b>{{ $link->original_url }}</b>
                </div>


            </div>

    </section>
    <section class="container mt-2">
        Tag:
    </section>
</x-layout.main>
