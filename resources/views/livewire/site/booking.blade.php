<form method="POST" wire:submit.prevent="sendForm()">

    <div class="my-3">
        @include('site.layouts.booking-message')
    </div>

    <div class="form-group d-flex flex-wrap flex-lg-nowrap ">
      <input type="text" wire:model="name" class="form-control me-lg-3 my-lg-0 my-3 @error('text') is-invalid @enderror" id="Name" placeholder="@lang('Name') *" required>
      <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="Email" aria-describedby="emailHelp" placeholder="@lang('Email') "  >
    </div>

    <div class="form-group my-3 d-flex flex-wrap flex-lg-nowrap ">
        <input type="date" wire:model="date" id="dateInput" class="w-100 py-1 form-control me-lg-3 my-lg-0 my-3 @error('date') is-invalid @enderror">
        <input type="tel" wire:model="mobile" class="form-control @error('mobile') is-invalid @enderror" id="Email" aria-describedby="emailHelp" placeholder="@lang('Mobile') *" required>
    </div>


    <div class="form-group my-3 d-flex  flex-wrap flex-lg-nowrap  align-items-center">

      <select wire:model="specialty_id" required class="form-select my-lg-0 my-3 " id="exampleFormControlSelect1">
        <option selected value="">@lang('Departments')</option>
        @forelse ($specialties as $specialty)
            <option value="{{ $specialty->id }}">
                {{ $specialty->trans->where('locale',$current_lang)->first()->title }}
            </option>
        @empty

        @endforelse
    </select>

    <div class="me-3"></div> <!-- Gap of 2rem -->

    <select  wire:model="doctor_id" required class="form-select my-lg-0 my-3 " id="exampleFormControlSelect1">
        <option selected value="">@lang('doctors.doctors')</option>
        @forelse ($doctors as $doctor)
            <option value="{{ $doctor->id }}">
                {{ $doctor->trans->where('locale',$current_lang)->first()->title }}
            </option>
        @empty

        @endforelse
      </select>
    </div>

    <div class="col-12 my-3">
        <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror"  id="exampleTextarea" rows="6" placeholder="@lang('Message ...')"></textarea>
    </div>

    <button type="submit" class="btn bg-main  text-lg-start text-center px-5"> @lang('Book Appointment') </button>

  </form>
