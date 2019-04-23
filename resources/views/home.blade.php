@extends('layouts.frontend')

@section('title') Welcome to Redprint! @stop

@section('intro')

  <section id="intro">

    <div class="intro-content">
      <h2>Your <span>Laravel App Development</span><br>on steroid!</h2>
      <div>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('{{ asset('frontend/images/intro-carousel/1.jpg') }}');"></div>
      <div class="item" style="background-image: url('{{ asset('frontend/images/intro-carousel/2.jpg') }}');"></div>
    </div>

  </section>

@stop

@section('content')

    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 about-img">
            <img src="{{asset('frontend/images/redprint_default.png') }}" alt="">
          </div>

          <div class="col-lg-10 content">
            <h2>Build Laravel Applications faster!</h2>
            <h3>Redprint App Builder is your app development flow on steroid! It can literally save you
            hundreds of hours of coding and lets you concentrate on what matters most. The application logic and problem solution.</h3>

          </div>
        </div>

      </div>
    </section>

    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 about-img">
            <img src="{{ asset('frontend/images/crud.png') }}" alt="">
          </div>

          <div class="col-lg-10 content">
            <h2>Generate CRUD Code faster and better.</h2>
            <h3>For repetative tasks like creating a CRUD, you can totally rely on Redprint App Builder. It generates high quality Code to generate your everyday create, read, update, delete interfaces and backend. Redprint App Builder closely follows Laravel best practices. Which means, no garbage code. You'll fall in love once you take a look at the code! We promise!</h3>

            <ul>
              <li><i class="ion-android-checkmark-circle"></i> Faster code generation.</li>
              <li><i class="ion-android-checkmark-circle"></i> Runs Code sniffer to make sure your code doesn't smell BAD.</li>
              <li><i class="ion-android-checkmark-circle"></i> DRY code. Reusable traits.</li>
            </ul>

          </div>
        </div>

      </div>
    </section>



    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 about-img">
            <img src="{{ asset('frontend/images/search.png') }}" alt="">
          </div>

          <div class="col-lg-10 content">
            <h2>A searchable, properly indexed Backend.</h2>
            <h3>With Redprint App Builder, you can tell the system to automatically generate your search system with the CRUD. Again, the code that gets genrated is of high quality and follows DRY. Have a look at the index method.</h3>

          </div>
        </div>

      </div>
    </section>



    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 about-img">
            <img src="{{ asset('frontend/images/relations.png') }}" alt="">
          </div>

          <div class="col-lg-10 content">
            <h2>Generate Model to Model Relationships with ease.</h2>
            <h3>With a few clicks, you can generate relations between two models. Not only that, it creates the dropdowns on a previously created CRUD that is related! For example, if you are creating a "Has Many" relationship between "Category" and "Products", your products CRUD form will now "automagically" have a dropdown to select Categories! <br />
            How cool is that?</h3>

          </div>
        </div>

      </div>
    </section>



    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 about-img">
            <img src="{{ asset('frontend/images/migrations.png') }}" alt="">
          </div>

          <div class="col-lg-10 content">
            <h2>Generate Migrations.</h2>
            <h3>Redprint AB lets you create a migration using a clean UI. Just focus on what you need and we'll generate then run the migration for you. If it doesn't look good, we'll debug and let you know that too!</h3>

          </div>
        </div>

      </div>
    </section>



    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 about-img">
            <img src="{{ asset('frontend/images/join.png') }}" alt="">
          </div>

          <div class="col-lg-10 content">
            <h2>Build tools</h2>
            <h3>Redprint AB does not want you to feel restricted. Alongside our PSR standard code, we made things super flexible. Redprint is for PRO and Beginner developers alike. A PRO developer can use it to speed up app development flow and a beginner can use it to get a kickstart in Laravel world. Redprint provides Build Tools that you can use to do almost everything one needs to work with Laravel.
            It lets you use Laravels default scaffolding features and useful commands right inside your browser. Redprint also comes with a fully featured Code Editor right inside! We really hope you will enjoy Redprint and contribute to its growth.</h3>

          </div>
        </div>

      </div>
    </section>
@stop