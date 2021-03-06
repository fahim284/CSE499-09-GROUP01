@extends("layouts.default")

@section("title") @parent Food @stop
@section('css')
    @parent
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@stop

@section("content")


    <div class="container" id="app">
        <div class="col-md-8">
            <form>
                <div class="form-group">
                  <el-select
                    v-model="product_id"
                    filterable
                    remote
                    reserve-keyword
                    placeholder="Please enter a keyword"
                    :remote-method="getProducts"
                    :loading="loading"
                    @change="getNutritionDetails"
                  >
                    <el-option
                      v-for="product in products"
                      :key="product.id"
                      :label="product.long_name"
                      :value="product.id">
                    </el-option>
                  </el-select>
                </div>

                <el-card class="box-card" v-loading="loading">
                  <div slot="header" class="clearfix">
                    <span>More Information</span>
                  </div>

                  <div class="text item" v-for="nutrient in nutrients">
                    @{{ nutrient.name }}: @{{ nutrient.value }} [@{{ nutrient.unit }}]
                  </div>

                </el-card>

                <p>How many units have you consumed?</p>
                <el-input-number v-model="intake"  :min="1" :max="1000"></el-input-number>

                <el-button type="success" plain @click.prevent="submit">Submit</el-button>

            </form>
        </div>
    </div>

@stop

@section("sidebar")
    {{-- <a href="{{ route("staff.index") }}" class="btn btn-success">All Staff</a> --}}
@stop


@section('css')
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
@parent



@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
  <script src="https://unpkg.com/element-ui/lib/index.js"></script>
  <script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
@parent


<script>
  ELEMENT.locale(ELEMENT.lang.en)
  var app = new Vue({
    el: '#app',
    data: function () {
      return {
        products: [],
        product_id: '',
        nutrients: [],
        loading: false,
        intake: 1
      }
    },
    methods: {
      getProducts: function (term) {
        var self = this
        self.loading = true
        axios.get('/food-catalogue', {params: { term: term } })
          .then(function (response) {
            self.products = response.data
            self.loading = false
          })
          .catch(function (response) {
            console.log(JSON.stringify(response))
          })
      },
      getNutritionDetails: function (product_id) {
        var self = this
        self.loading = true
        axios.get('/food/nutrition-details/' + product_id)
          .then(function (response) {
            // console.log(JSON.stringify(response))
            self.nutrients = response.data.report.food.nutrients
            self.product_id = product_id
            self.loading = false
          })
          .catch(function (response) {
            console.log(JSON.stringify(response))
          })
      },
      submit: function () {
        var nutrients = this.nutrients
        var energy = nutrients.find(x => x.name === 'Energy').value
        var data = { energy: energy, product_id: this.product_id, intake: this.intake }
        var self = this
        axios.post('/food/consume', data)
          .then(function (response) {
            // console.log(JSON.stringify(response))
            self.nutrients = []
            self.product_id = ''
            self.loading = false
            self.$alert('Thank you for submitting.', 'Done!')
          })
          .catch(function (response) {
            console.log(JSON.stringify(response))
          })

      }
    },
    mounted: function () {
    }
  })

</script>

@stop