<template>
  <gmap-map
      :center="getCenter()"
      :style="{
                  width: '100%',
                  height: '600px'
              }"
      :zoom="map_config.zoom"
      map-type-id="terrain"
      ref="map_ref"
  >

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
</template>

<script>
import axios from "axios"

export default {
  props: {
    map_config: Object,
    tempat_penyewaans: Array,
  },

  data() {
    return {
      m_tempat_penyewaans: this.tempat_penyewaans.map(tempat => ({
        ...tempat,
        infoWindowOpen: false,
      }))
    }
  },

  methods: {
    getCenter() {
      return {
        lat: this.map_config.center.latitude,
        lng: this.map_config.center.longitude
      }
    },
  }
}
</script>
