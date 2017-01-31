require('./bootstrap.js');

const vm = new Vue({
	el: '#app',
	data: {
		'amenities' : [],
		'selectedAmenities' : [],
		'unselectedAmenities' : [],
		'token' : document.querySelector("meta[name='csrf_token']").content,
	},
	methods: {
		mountAmenity() {
			this.$http.get('/api/amenities/list')
			.then(response => {
				this.amenities = response.data
			})
			.catch(error => {
				console.log('Unable to load the list of amenities.')
			})
		}, // mountAmenity
		toggleAmenityModal() {
			// mounting the list of amenities available before toggling the modal.
			this.mountAmenity()
			$("#amenityModal").modal("toggle")
		},
		/**
		 * Function that assigns an amenity to a property
		 * @parameter int property
		 * @parameter EventHandle event
		*/
		saveAmenity(property) {
			this.$http.post('/api/amenities/save', {
				_method : 'post',
				_token : this.token,
				selectedAmenities : this.selectedAmenities,
				unselectedAmenities : this.unselectedAmenities,
				property : property
			})
			.then(response => {
				console.log(response.data)
			})
			.catch(error => {

			})
		},
		/**
		 * Function that toggles an amenity to a property
		 * @param EventHandle event
		 *
		*/
		toggleAmenity(event) {
			if (this.selectedAmenities.indexOf(event.target.value) < 0) {
				this.selectedAmenities.push(event.target.value)

				if (this.unselectedAmenities.indexOf(event.target.value) > 0) {
					let removeIndex = this.unselectedAmenities.indexOf(event.target.value)
					this.unselectedAmenities.splice(removeIndex, 1)
				}
			} else {
				let removeIndex = this.selectedAmenities.indexOf(event.target.value)
				this.selectedAmenities.splice(removeIndex, 1)
				this.unselectedAmenities.push(event.target.value)
			}
		},
		/**
		* Checks if the amenity is already assigned 
		* to the property.
		*/
		isAlreadyAssigned(assignedAmenity, amenity) {
			return assignedAmenity === amenity
		}
	},
});