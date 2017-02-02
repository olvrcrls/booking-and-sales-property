require('./bootstrap.js');

const vm = new Vue({
	el: '#app',
	data: {
		'amenities' : [],
		'toggledAmenities' : [],
		'propertyAmenities' : [],
		'property' : '',
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
			// this.mountAmenity()
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
				toggledAmenities : this.toggledAmenities,
				property : property
			})
			.then(response => {
				console.log(response.data)
				this.toggledAmenities = [];
				// alert("Successfully assigned amenity.") // temporary
				$("#amenityModal").modal("hide")
				// prompt a message that the amenities are successfully assigned.
			})
			.catch(error => {
				console.log(error)
			})
		},
		/**
		 * Function that toggles an amenity to a property
		 * @param EventHandle event
		 *
		*/
		toggleAmenity(event) {
			if (this.toggledAmenities.indexOf(event.target.value) < 0) {
				this.toggledAmenities.push(event.target.value)
			} else {
				let removeIndex = this.toggledAmenities.indexOf(event.target.value)
				this.toggledAmenities.splice(removeIndex, 1)
			}
		},
		/**
		* Checks if the amenity is already assigned 
		* to the property.
		*/
		// isAlreadyAssigned(assignedAmenity, amenity) {
		// 	return assignedAmenity === amenity
		// },

		toggleUploadModal() {
			$("#uploadModal").modal("show")
		}
	},
});