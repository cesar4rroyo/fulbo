<template>
  <div class="row no-gutters">
    <div class="col-md-6">
      <div class="d-inline-block position-relative"
           style="width: 100%"
      >
        <div style="margin-top: 100%"></div>

        <div
            class="position-absolute"
            style="top: 0; bottom: 0; left: 0; right: 0; background: teal"
        >
          <gmap-map
              :center="getCenter()"
              :style="{
                            width: '100%',
                            height: '100%'
                        }"
              :zoom="map_config.zoom"
              @click="onMapClick"
              map-type-id="terrain"
              ref="map_ref"
          >
            <!-- Marker pointer -->
            <gmap-marker
                :position="{lat: pointer_marker.latitude, lng: pointer_marker.longitude}"
            />

            <template v-for="tempat in m_tempat_penyewaans">
              <gmap-marker
                  :key="`tempat_${tempat.id}`"
                  :position="{lat: tempat.latitude, lng: tempat.longitude}"
                  @click="tempat.infoWindowOpen = true"
              />

              <gmap-info-window
                  :opened="tempat.infoWindowOpen"
                  :position="{lat: tempat.latitude, lng: tempat.longitude}"
                  @closeclick="tempat.infoWindowOpen = false"
              >
                <div class="h4"> {{ tempat.nama }}</div>
                <p>
                  {{ tempat.alamat }}
                </p>
              </gmap-info-window>
            </template>


          </gmap-map>

        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">

          <dl>
            <dt> Nama Tempat Penyewaan </dt>
            <dd> {{ tempat_penyewaan.nama }} </dd>

            <dt> Alamat </dt>
            <dd> {{ tempat_penyewaan.alamat }} </dd>
          </dl>

          <hr>

          <form @submit.prevent="onFormSubmit">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="latitude">
                    Latitude:
                  </label>

                  <input
                      :class="{
                                            'is-invalid': get(error_data, 'errors.latitude[0]', false)
                                        }"
                      class="form-control"
                      id="latitude"
                      placeholder="Latitude"
                      step="any"
                      type="number"
                      v-model.number="pointer_marker.latitude"
                  >
                  <span class="invalid-feedback">
                                        {{ get(error_data, 'errors.latitude[0]', '') }}
                                    </span>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="longitude">
                    Longitude:
                  </label>

                  <input
                      :class="{
                                            'is-invalid': get(error_data, 'errors.longitude[0]', false)
                                        }"
                      class="form-control"
                      id="longitude"
                      placeholder="Longitude"
                      step="any"
                      type="number"
                      v-model.number="pointer_marker.longitude"
                  >
                  <span class="invalid-feedback">
                                        {{ get(error_data, 'errors.longitude[0]', '') }}
                                    </span>
                </div>
              </div>
            </div>

            <div class="form-group d-flex justify-content-end">
              <button class="btn btn-primary">
                Perbarui Data
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios"

export default {
  props: {
    map_config: Object,
    tempat_penyewaan: Object,
    tempat_penyewaans: Array,
    submit_url: String,
    redirect_url: String,
  },

  data() {
    return {
      pointer_marker: {
        latitude: this.tempat_penyewaan.latitude,
        longitude: this.tempat_penyewaan.longitude,
      },

      m_tempat_penyewaans: this.tempat_penyewaans.map(tempat => ({
        ...tempat,
        infoWindowOpen: false,
      }))
    }
  },


  methods: {
    getCenter() {
      if (!!this.tempat_penyewaan.latitude && !!this.tempat_penyewaan.longitude) {
        return {
          lat: this.tempat_penyewaan.latitude,
          lng: this.tempat_penyewaan.longitude
        }
      }

      return {
        lat: map_config.center.latitude,
        lng: map_config.center.longitude
      }
    },

    onFormSubmit() {
      axios.put(this.submit_url, this.computedFormData())
          .then(response => {
            window.location.replace(this.redirect_url)
          })
          .catch(error => {
            this.error_data = this.get(error, "response.data")
          })
    },

    computedFormData() {
      return {
        latitude: this.pointer_marker.latitude,
        longitude: this.pointer_marker.longitude,
      }
    },

    onMapClick(e) {
      this.pointer_marker = {
        latitude: e.latLng.lat(),
        longitude: e.latLng.lng(),
      }
    },
  }
}
</script>
