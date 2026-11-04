# Custom Field Implementation Decision Log

## Project: Multi-Branch Clinic Booking Platform

### Comparison of ACF vs Native WordPress Custom Fields

| Trade-off | Advanced Custom Fields (ACF) | Native WordPress Meta Fields |
|---|---|---|
| Ease of Use | User-friendly interface for managing fields | Requires custom PHP code and development |
| Performance | Adds plugin functionality and overhead | Lightweight with no additional plugin dependency |
| Future Maintenance | Depends partly on plugin updates and compatibility | Full control over implementation and maintenance |
| Scalability | Flexible for adding complex field groups | Can be extended with custom code as requirements grow |

## Research Notes

### Advanced Custom Fields (ACF)
- Provides a visual interface for creating and managing custom fields.
- Makes field management easier for non-technical administrators.
- Adds a plugin dependency to the project.

### Native WordPress Meta Fields
- Uses WordPress APIs such as register_post_meta() and update_post_meta().
- Provides more control over field registration and validation.
- Requires additional PHP development and maintenance.

## Final Decision

I have selected native WordPress custom fields using register_post_meta() for Branch and Doctor data. This approach avoids an additional plugin dependency and provides direct control over field registration, validation, sanitization, and permissions. Both approaches use WordPress post meta storage, so query performance will depend on how the data is structured and queried. Native fields are the better fit for this project because they provide flexibility and control for long-term maintenance.

Pending research and evaluation.