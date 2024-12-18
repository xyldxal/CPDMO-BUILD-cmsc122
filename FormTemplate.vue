<template>
  <div class="popup-overlay">
    <div class="popup-container">
      <div class="popup-header">
        <h2>ADD ENTRY</h2>
        <button class="close-button" @click="$emit('close')">&times;</button>
      </div>
      
      <div class="tab-container">
        <div class="tab active">Project Details</div>
        <div class="tab">Planning and Design</div>
        <div class="tab">BAC Bidding</div>
        <div class="tab">Procurement</div>
        <div class="tab">Implementation</div>
        <div class="tab">SPMO</div>
        <div class="tab">Acceptance</div>
        <div class="tab">Release of Retention</div>
      </div>

      <form @submit.prevent="submitForm">
        <div class="form-row">
          <div class="form-group half-width">
            <label>Tracking Number</label>
            <input
              type="text"
              v-model="form.trackingNumber"
              class="form-control"
              required
            />
          </div>
          <div class="form-group half-width">
            <label>Project Title</label>
            <input
              type="text"
              v-model="form.projectTitle"
              class="form-control"
              required
            />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group half-width">
            <label>Fund Source</label>
            <input
              type="text"
              v-model="form.fundSource"
              class="form-control"
              required
            />
          </div>
          <div class="form-group half-width">
            <label>End User</label>
            <input
              type="text"
              v-model="form.endUser"
              class="form-control"
              required
            />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group half-width">
            <label>Budget</label>
            <input
              type="number"
              v-model="form.budget"
              class="form-control"
              required
            />
          </div>
          <div class="form-group half-width">
            <label>Contractor</label>
            <input
              type="text"
              v-model="form.contractor"
              class="form-control"
              required
            />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group half-width">
            <label>Bid Amount</label>
            <input
              type="number"
              v-model="form.bidAmount"
              class="form-control"
              required
            />
          </div>
        </div>

        <div class="form-group">
          <label>Project Description</label>
          <textarea
            v-model="form.projectDescription"
            class="form-control"
            rows="4"
            required
          ></textarea>
        </div>

        <div class="form-actions">
          <button type="submit" class="save-button">SAVE</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AddEntryForm',
  data() {
    return {
      form: {
        trackingNumber: '',
        projectTitle: '',
        projectDescription: '',
        fundSource: '',
        endUser: '',
        budget: null,
        bidAmount: null,
        contractor: '',
      }
    }
  },
  methods: {
    submitForm() {
      // Handle form submission
      console.log(this.form)
      this.$emit('submit', this.form)
    }
  }
}
</script>

<style scoped>
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-container {
  background: white;
  border-radius: 8px;
  width: 90%;
  max-width: 800px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.popup-header h2 {
  margin: 0;
  color: #8B0000;
}

.close-button {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #666;
}

.tab-container {
  display: flex;
  overflow-x: auto;
  margin-bottom: 20px;
  border-bottom: 1px solid #ddd;
}

.tab {
  padding: 10px 20px;
  cursor: pointer;
  white-space: nowrap;
  border-bottom: 2px solid transparent;
}

.tab.active {
  border-bottom: 2px solid #8B0000;
  color: #8B0000;
}

.form-row {
  display: flex;
  gap: 20px;
  margin-bottom: 15px;
}

.form-group {
  margin-bottom: 15px;
  width: 100%;
}

.half-width {
  width: 50%;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
}

.form-control {
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
}

textarea.form-control {
  resize: vertical;
  min-height: 100px;
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.save-button {
  background-color: #006400;
  color: white;
  border: none;
  padding: 10px 30px;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

.save-button:hover {
  background-color: #005000;
}
</style>