# Multi-Branch Clinic Booking Platform

A WordPress-based clinic booking platform for managing multiple clinic branches and their doctors.

## Custom Field Decision

This project compares Advanced Custom Fields (ACF) with native WordPress custom fields for managing Branch and Doctor data.

### Comparison Table

| Criteria | Advanced Custom Fields (ACF) | Native WordPress Custom Fields |
|---|---|---|
| Ease of Use | Easy visual interface for managing fields | Requires PHP development |
| Performance | Adds plugin functionality and dependency | Lightweight without an additional plugin |
| Future Maintenance | Depends partly on plugin compatibility and updates | Full control over code and maintenance |
| Scalability | Supports flexible field groups | Can be extended through custom development |

For the detailed comparison and implementation decision, see [DECISION_LOG.md](DECISION_LOG.md).

### Final Decision

I selected native WordPress custom fields for managing Branch and Doctor data. This approach provides better control over field registration, validation, and data management while reducing additional plugin dependencies. Although ACF is easier for non-technical users, native fields offer more flexibility for long-term maintenance and future scalability.

---

## Branch and Doctor Custom Post Types

The plugin registers two custom post types:

- **Branch (`clinic_branch`)** – Manages clinic branch information.
- **Doctor (`clinic_doctor`)** – Manages doctor profiles and their assigned branches.

Both post types support titles, editor content, featured images, and custom fields. They are registered using WordPress `register_post_type()`.

### Custom Fields

**Branch Fields**

| Field | Description |
|---|---|
| `branch_address` | Branch location/address |
| `branch_phone` | Branch contact number |
| `branch_opening_hours` | Branch operating hours |

**Doctor Fields**

| Field | Description |
|---|---|
| `doctor_specialty` | Doctor's medical specialty |
| `doctor_phone` | Doctor's contact number |
| `doctor_branch_id` | ID of the assigned clinic branch |

Custom fields are registered using WordPress `register_post_meta()` and displayed through custom meta boxes in the WordPress admin.

### Doctor-to-Branch Relationship

Each doctor is assigned to a clinic branch through the `doctor_branch_id` custom field.

The field stores the corresponding Branch post ID, allowing doctors to be associated with their respective clinic locations.

---

## Demo Seed Data

The project includes a seed data script that generates sample clinic branches and doctor profiles.

### Seed Dataset

- **9 clinic branches**
- **27 doctor profiles**
- **3 doctors assigned to each branch**

The sample dataset includes branches in Multan, Lahore, Karachi, Islamabad, Faisalabad, Peshawar, Quetta, Sialkot, and Bahawalpur.

### How to Generate Demo Data

1. Activate the Multi-Branch Clinic Booking plugin.
2. Open the WordPress admin dashboard.
3. Locate the HealthFirst Demo Data notice.
4. Click **Generate Demo Data**.
5. Visit Branches and Doctors in the WordPress admin to verify the generated records.

The seed script includes a completion flag to prevent accidental repeated generation.

### Seed Script

The demo data generation functionality is implemented in:

`includes/seed-data.php`

---

## Front-End Branch and Doctor Templates

The project includes custom front-end templates in the Twenty Twenty-Five child theme.

### Branch Detail Page

The `single-clinic_branch.php` template displays:

- Branch name
- Branch address
- Contact phone number
- Opening hours
- Doctors assigned to the branch

Doctors are retrieved using `WP_Query` and the `doctor_branch_id` custom field. The meta query uses the `NUMERIC` type to match branch IDs correctly.

Each doctor name links to its individual doctor detail page.

### Doctor Detail Page

The `single-clinic_doctor.php` template displays:

- Doctor name
- Medical specialty
- Contact phone number
- Assigned clinic branch with a link to its detail page
- **Book an Appointment** button

The booking button links to the WordPress page with the `book-appointment` slug.

### Responsive Design

The child theme includes responsive CSS for desktop, tablet, and mobile screen sizes.

The branch doctor grid adjusts its columns according to screen width, while doctor detail pages and booking buttons remain accessible on smaller screens.

### Child Theme Files

The child theme files are included in this repository under `child-theme/` for project review.

To use the templates on the local WordPress site, place the files in the active child theme directory:

`wp-content/themes/twentytwentyfive-child/`

The child theme contains:

- `style.css` – Theme information and responsive front-end styles.
- `functions.php` – Enqueues parent and child theme stylesheets.
- `single-clinic_branch.php` – Branch detail page template.
- `single-clinic_doctor.php` – Doctor detail page template.

---

## Plugin Structure

```text
multi-branch-clinic-booking/
│
├── child-theme/
│   ├── functions.php
│   ├── single-clinic_branch.php
│   ├── single-clinic_doctor.php
│   └── style.css
│
├── includes/
│   ├── post-types.php
│   ├── custom-fields.php
│   └── seed-data.php
│
├── multi-branch-clinic-booking.php
├── DECISION_LOG.md
└── README.md
```

### File Responsibilities

- `multi-branch-clinic-booking.php` – Main plugin file and includes other PHP files.
- `includes/post-types.php` – Registers Branch and Doctor custom post types.
- `includes/custom-fields.php` – Registers native custom fields, meta boxes, and save functionality.
- `includes/seed-data.php` – Generates demo branches and doctors.
- `child-theme/` – Contains the front-end child theme templates and styles.
- `DECISION_LOG.md` – Documents the custom field implementation decision.

---

## Technologies Used

- WordPress
- PHP
- MySQL
- Native WordPress Custom Post Types
- Native WordPress Custom Fields
- Git and GitHub
