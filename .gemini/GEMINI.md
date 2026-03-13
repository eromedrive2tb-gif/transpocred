# Global Refactoring & Architecture Rules

## 1. Character & Naming Constraints
- **PROHIBITED NAMES**: Never use: Caelum, Kaelen, Valerius, Thorne, Vance, Vane.
- **NAMING THEME**: Unique names inspired by Greek, Norse, or Hindu mythology (Name only, ignore cultural origins).

## 2. Refactoring Protocol (Legacy PHP)
- **MODULARIZATION FIRST**: Strictly separate Business Logic, Data Access, and UI.
- **FILE SPLITTING**: 
    - **Logic**: `src/Controllers/` or `src/Services/`.
    - **Data/Persistence**: `src/Models/` or `src/Repositories/`.
    - **UI/Output**: `templates/` or `views/`.
- **ASSETS HANDLING**: Identify immutable artifacts (minified, vendor-specific, or auto-generated). Move them to `public/assets/` and treat them as Read-Only.
- **ZERO FUNCTIONAL CHANGE**: Maintain 1:1 functional parity. Repartitioning is the only goal.

## 3. Execution Strategy (IDE Thinking)
- **HOLISTIC ANALYSIS**: Before proposing any code, analyze the entire file tree to identify cross-dependencies between the 10 core files.
- **DEPENDENCY MAPPING**: Map how `users.json` is accessed across all files to ensure the new Data Layer doesn't break session management.
- **ATOMIC COMMITS**: Present the refactor in logical steps (e.g., "Step 1: Extracting Auth Logic", "Step 2: Isolating Dashboard View").