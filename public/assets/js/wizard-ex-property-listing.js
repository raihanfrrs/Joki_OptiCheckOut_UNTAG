/**
 *  Form Wizard
 */

'use strict';

(function () {
  // Init custom option check
  window.Helpers.initCustomOptionCheck();

  const flatpickrRange = document.querySelector('.flatpickr'),
    phoneMask = document.querySelector('.contact-number-mask'),
    countrySelect = $('#country'),
    goods_handling_equipment = document.querySelector('#goods_handling_equipment');

  // Phone Number Input Mask
  if (phoneMask) {
    new Cleave(phoneMask, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

  if (flatpickrRange) {
    flatpickrRange.flatpickr();
  }

  const country_id = $('#country_id');
  if (country_id.length) {
    country_id.wrap('<div class="position-relative"></div>');
    country_id
      .select2({
        placeholder: 'Select Country',
        dropdownParent: country_id.parent()
      });
  }

  const warehouse_category_id = $('#warehouse_category_id');
  if (warehouse_category_id.length) {
    warehouse_category_id.wrap('<div class="position-relative"></div>');
    warehouse_category_id
      .select2({
        placeholder: 'Select Warehouse Type',
        dropdownParent: warehouse_category_id.parent()
      });
  }

  const goods_handling_equipment_list = [
    'Forklift',
    'Stacker',
    'Pallet Jack (Hand Pallet Truck)',
    'Conveyor Belt',
    'Racking Systems',
    'Washing Machine',
    'Overhead Crane',
    'Automated Guided Vehicles (AGVs)',
    'Reach Trucks',
    'Hand Trucks',
    'Pneumatic Tube Systems'
  ];
  if (goods_handling_equipment) {
    new Tagify(goods_handling_equipment, {
      whitelist: goods_handling_equipment_list,
      maxTags: 20,
      dropdown: {
        maxItems: 20,
        classname: 'tags-inline',
        enabled: 0,
        closeOnSelect: false
      }
    });
  }

  // Vertical Wizard
  // --------------------------------------------------------------------

  const wizardPropertyListing = document.querySelector('#wizard-property-listing');
  if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
    // Wizard form
    const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-property-listing-form');
    // Wizard steps
    const wizardPropertyListingFormStep1 = wizardPropertyListingForm.querySelector('#personal-details');
    const wizardPropertyListingFormStep2 = wizardPropertyListingForm.querySelector('#account-details');
    // Wizard next prev button
    const wizardPropertyListingNext = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-next'));
    const wizardPropertyListingPrev = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardPropertyListing, {
      linear: true
    });

    // Personal Details
    const FormValidation1 = FormValidation.formValidation(wizardPropertyListingFormStep1, {
      fields: {
        first_name: {
          validators: {
            notEmpty: {
              message: 'Please enter first name'
            }
          },
        },
        last_name: {
          validators: {
            notEmpty: {
              message: 'Please enter last name'
            }
          },
        },
        email: {
          validators: {
            notEmpty: {
              message: 'Please enter email'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          },
        },
        phone: {
          validators: {
            notEmpty: {
              message: 'Please enter phone number'
            },
            regexp: {
              regexp: /^[0-9]*$/,
              message: 'The value is not a valid number'
            }
          },
        },
        address: {
          validators: {
            notEmpty: {
              message: 'Please enter address'
            }
          },
        },
        gender: {
          validators: {
            notEmpty: {
              message: 'Please select gender'
            }
          },
        },
        dob: {
          validators: {
            notEmpty: {
              message: 'Please select date of birth'
            }
          },
        },
        pob: {
          validators: {
            notEmpty: {
              message: 'Please enter place of birth'
            }
          },
        },
        cashier_image: {
          validators: {
            notEmpty: {
              message: 'Please upload cashier image'
            }
          },
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6, .col-sm-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    const FormValidation2 = FormValidation.formValidation(wizardPropertyListingFormStep2, {
      fields: {
        username: {
          validators: {
            notEmpty: {
              message: 'Please enter username'
            }
          },
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Please enter password'
            },
            length: {
              min: 6,
              message: 'The password must be at least 6 characters'
            },
            contains: {
              message: 'The password must contain at least one uppercase letter, one lowercase letter, and one number',
              pattern: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/
            }
          },
        },
        confirm_password: {
          validators: {
            notEmpty: {
              message: 'Please enter confirm password'
            },
            identical: {
              compare: function () {
                return wizardPropertyListingFormStep2.querySelector('[name="password"]').value;
              },
              message: 'The password and its confirm are not the same'
            }
          },
        },
        confirm_password_update: {
          validators: {
            identical: {
              compare: function () {
                return wizardPropertyListingFormStep2.querySelector('[name="password_update"]').value;
              },
              message: 'The password and its confirm are not the same'
            }
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-4'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      let form = $(".form-submit-cashier");
      form.attr('onsubmit', 'return true');
      form.submit();
    });

    wizardPropertyListingNext.forEach(item => {
      item.addEventListener('click', event => {
        // When click the Next button, we will validate the current step
        switch (validationStepper._currentIndex) {
          case 0:
            FormValidation1.validate();
            break;

          case 1:
            FormValidation2.validate();
            break;

          default:
            break;
        }
      });
    });

    wizardPropertyListingPrev.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {
          case 1:
            validationStepper.previous();
            break;
          case 0:
          default:
            break;
        }
      });
    });
  }
})();
