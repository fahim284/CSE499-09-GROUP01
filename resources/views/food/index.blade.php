@extends("layouts.default")

@section("title") @parent Food @stop

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
                    @change="getServingSize"
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
                  <div class="text item">
                    Serving Size: @{{ serving_size.serving_size }}
                  </div>

                  <div class="text item">
                    Serving Size UOM: @{{ serving_size.serving_size_uom }}
                  </div>

                  <div class="text item">
                    House hold Serving Size: @{{ serving_size.household_serving_size }}
                  </div>


                  <div class="text item">
                    House hold Serving Size UOM: @{{ serving_size.household_serving_size_uom }}
                  </div>

                </el-card>

                <p>How many units have you consumed?</p>
                <el-input-number v-model="intake"  :min="1" :max="1000"></el-input-number>

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
        serving_size: '',
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
      getServingSize: function (product_id) {
        var self = this
        self.loading = true
        axios.get('/food/serving-size/' + product_id)
          .then(function (response) {
            self.serving_size = response.data
            self.loading = false
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