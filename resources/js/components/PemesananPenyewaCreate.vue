<template>
  <form @submit.prevent="onFormSubmit">
    <div class="form-group">
      <label for="tanggal_pemesanan">
        Waktu Pemesanan:
      </label>

      <input
          :class="{
            'is-invalid': get(error_data, 'errors.tanggal_pemesanan[0]', false)
          }"
          class="form-control"
          id="tanggal_pemesanan"
          placeholder=""
          type="date"
          v-model="tanggal_pemesanan"
      >

      <span class="invalid-feedback">
          {{ get(error_data, 'errors.tanggal_pemesanan[0]', '') }}
      </span>
    </div>

    <table class="table table-sm table-striped table-hover table-bordered">
      <thead class="thead-dark">
      <tr>
        <th> #</th>
        <th> Periode</th>
        <th class="text-center"> Pesan?</th>
      </tr>
      </thead>

      <tbody>
      <tr v-for="(session, index) in m_possible_sessions">
        <td> {{ index + 1 }}</td>
        <td> {{ `${session.start} - ${session.finish}` }}</td>
        <td class="text-center align-middle">
          <input
              v-model="session.picked"
              type="checkbox"
              style="width: 20px; height: 20px"
              :id="`picked_${index}`">
        </td>
      </tr>
      </tbody>
    </table>

    <div class="form-group d-flex justify-content-end">
      <button class="btn btn-primary btn-lg">
          Pesan
      </button>
    </div>

  </form>
</template>

<script>
import moment from 'moment'

export default {
  props: {
    "tempat_penyewaan": Object,
    "possible_sessions": Array,
    "submit_url": String,
    "redirect_url": String
  },

  data() {
    return {
      m_possible_sessions: this.possible_sessions.map(session => ({
        ...session,
        picked: false,
      })),

      tanggal_pemesanan: moment().format("YYYY-MM-DD"),
    }
  }
}
</script>
