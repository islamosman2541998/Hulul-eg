<!--Whatsapp-->
<a class="whatsapp-icon" id="whatsapp-icon" title="Contact us on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<div class="whatsapp-info" id="whatsapp-info">
    <div class="card text-center">
        <div class="card-header">
            Our customer support team is here to answer your questions. Ask us
            anything!
        </div>
        <div class="card-body">
            <ul class="p-0">
                @foreach ($contacts as $contact)
                    <li class="text-center">
                        <a href="https://wa.me/2{{ $contact->number }}" target="_blank" rel="noopener noreferrer">
                            <h5 class="card-title mb-1">
                                {{ $contact->transNow->title }}
                            </h5>
                            <div class="d-flex align-items-center justify-content-center gap-3  mb-2">

                                <span><i class="fa-solid fa-user icon-wh fs-4"></i></span>
                                <p class="mb-0">{{ $contact->number }}</p>
                            </div>
                        </a>
                    </li>
                @endforeach



            </ul>
        </div>
    </div>
</div>
<!--Whatsapp-->
<style>
    .icon-wh {
        color: rgba(139, 135, 135, 0.966);
    }
</style>
